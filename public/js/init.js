$(function() {
    var $tabButtonItem = $('#tab-button li'),
        $tabSelect = $('#tab-select'),
        $tabContents = $('.tab-contents'),
        activeClass = 'is-active';

    $tabButtonItem.first().addClass(activeClass);
    $tabContents.not(':first').hide();

    $tabButtonItem.find('a').on('click', function(e) {
        var target = $(this).attr('href');

        $tabButtonItem.removeClass(activeClass);
        $(this).parent().addClass(activeClass);
        $tabSelect.val(target);
        $tabContents.hide();
        $(target).show();
        e.preventDefault();
    });

    $tabSelect.on('change', function() {
        var target = $(this).val(),
            targetSelectNum = $(this).prop('selectedIndex');

        $tabButtonItem.removeClass(activeClass);
        $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
        $tabContents.hide();
        $(target).show();
    });

});

function openMenu(id) {
    $('#modal-search').modal('hide');
    $('#modal-load').modal('hide');
    $('#modal-terminasi').modal('hide');
    $('#modal-import').modal('hide');
    $('#modal-save').modal('hide');
    $('#modal-draw').modal('hide');
    $('#modal-layer').modal('hide');
    $('#modal-setting').modal('hide');
    $('#modal-shp').modal('hide');
    $('#modal-dinas').modal('hide');

    $('#modal-infoPolyline').modal('hide');
    $('#modal-infoPoint').modal('hide');
    $('#modal-infoPolygon').modal('hide');

    if (id) {
        $(id).modal('show');
    }
}

function destroyObject(kode) {
    var layer = ObjectControl.getObjectById(kode);

    swal({
        title: "Are you sure, you want to delete?",
        showCancelButton: true,
        type: "warning",
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak"
    }, function(isConfirm) {
        if (isConfirm) {
            ObjectControl.Remove(layer);
            $('#modal-infoPolygon').modal("hide");
            $('#modal-infoPolyline').modal("hide");
        }
    })
}

function createLayer(type, detail) {
    if (type == "tileLayer") {
        var layer = L.tileLayer(detail.url, {
            maxZoom: detail.maxZoom,
            attribution: detail.attr
        })
        return layer;
    } else if (type == "arcgis") {
        var layer = false;
        if (detail.typeArcgis == 1) {
            layer = L.esri.dynamicMapLayer({
                url: detail.url,
                maxZoom: detail.maxZoom,
                attribution: detail.attr,
                useCors: false
            })
        } else if (detail.typeArcgis == 2) {
            layer = L.esri.imageMapLayer({
                url: detail.url,
                maxZoom: detail.maxZoom
            })
        } else if (detail.typeArcgis == 3) {
            layer = L.esri.featureLayer({
                url: detail.url,
                // maxZoom : detail.maxZoom
            })
        }

        return layer;
    } else if (type == "geoserver") {
        let layer = false;
        if (detail.typeGeo == 1) {
            layer = L.tileLayer.wms(detail.url, {
                layers: detail.layers,
                format: 'image/png',
                transparent: true
            })
        }
        return layer;
        // console.log(layer);
    }
}

function removeMap() {
    var layer = ObjectControl.getAllLayer();
    if (layer.length != 0) {
        openMenu();
        swal({
            title: "Bersihkan map?",
            showCancelButton: true,
            type: "warning",
            confirmButtonText: "Iya",
            cancelButtonText: "Tidak"
        }, function(isConfirm) {
            if (isConfirm) {
                ObjectControl.removeAll();
            }
        });
    }
}
var feature_wiup = false;
var feature_inputbaru = false;
var feature_layer_wiup = false;

function serverAuth(callback) {
    // console.log(L);
    L.esri.post('https://momi.minerba.esdm.go.id/gisportal/sharing/rest/generateToken', {
        username: 'maxxima',
        password: 'ApaAjaB3bas',
        f: 'json',
        expiration: 86400,
        client: 'referer',
        referer: window.location.origin
    }, callback);
}
if (!window.location.origin) {
    window.location.origin = window.location.protocol + '//' + window.location.hostname + (window.location.port ? ':' + window.location.port : '');
}
// console.log(daftarLayer);
serverAuth(function(error, response) {
    if (error) {
        return;
    }
    let detail_inputbaru = {
        typeArcgis: 3,
        url: "https://momi.minerba.esdm.go.id/gisserver/rest/services/maxxima/InputBaru_Dev/FeatureServer/0",
    }
    let detail_wiup = {
        typeArcgis: 3,
        url: "https://momi.minerba.esdm.go.id/gisserver/rest/services/maxxima/WIUP_Dev/FeatureServer/0",
    }

    feature_inputbaru = createLayer("arcgis", detail_inputbaru);
    feature_wiup = createLayer("arcgis", detail_wiup);

    // ObjectControl.AddToMap(feature);
    feature_inputbaru.on('authenticationrequired', function(e) {
        serverAuth(function(error, response) {
            if (error) {
                r3eturn;
            }
            e.authenticate(response.token);
        })
    })
    feature_wiup.on('authenticationrequired', function(e) {
        serverAuth(function(error, response) {
            if (error) {
                return;
            }
            e.authenticate(response.token);
        })
    })
})