var ControlLeafletAjax = {
    initialize : function(position){
        this.command = L.control({position: position});
        this.command.onAdd = function(map){
            var div = L.DomUtil.create('div', 'formbasemap');
            div.id = "LeafletAjaxMenu";
            div.innerHTML += '<div id="card-LeafletAjax" class="collapse PluginMenu">\
                                <div class="card">\
                                <div class="card-header-vtms-list text-left text-light">\
                                    <button type="button" class="close" id="closeMenuLeafletAjax" aria-label="Close">\
                                          <span aria-hidden="true">&times;</span>\
                                    </button>\
                                    <h4>Layer LeafletAjax</h4>\
                                </div>\
                                <div class="card-body-vtms-list" id="isiLeafletAjax" style="height: 200px;">\
                                    <span>Tambahkan File : </span><input type="text" class="form-control" id="urlLeafletAjax">\
                                    <input type="file" class="form-control" accept="" id="urlFileLeafletAjax" multiple>\
                                    <div id="transparent-container">\
                                        <label>\
                                            <input id="file-checkbox" type="checkbox">\
                                            With Choose File\
                                        </label><br>\
                                        <label>\
                                            File : geojson,json\
                                        </label>\
                                    </div>\
                                    <input type="text" id="urlFile">\
                                </div>\
                                <div class="card-head-vtms-list">\
                                    <div>\
                                        <button id="tambahLeafletAjax" class="btn btn-info btn-sm" style="float: left;color: black;">Add</button>\
                                        <button id="hapusLeafletAjax" class="btn btn-danger btn-sm" style="float: right;">Hapus</button>\
                                    </div>\
                                </div>\
                                <div class="card-header-vtms-list text-left text-light">&nbsp;</div>\
                                </div>\
                            </div>\
                                ';
            div.innerHTML += '<div id="LeafletAjax" title="Layer-LeafletAjax">Ajax</div>';
            return div;
        }

        this.command.addTo(map);

        this.urlLeafletAjax = $('#urlLeafletAjax');
        this.urlFileLeafletAjax = $('#urlFileLeafletAjax');
        this.urlFile = $('#urlFile');
        this.tambahLeafletAjax = $('#tambahLeafletAjax');
        this.hapusLeafletAjax = $('#hapusLeafletAjax');

        this.fileCheckbox = $('#file-checkbox');

        $('#LeafletAjaxMenu').draggable();
        $('#LeafletAjaxMenu').on('dragstart',function(evt){
            map.dragging.disable();
        }).on('dragstop',function(evt){
            map.dragging.enable();
        });

        this.urlFileLeafletAjax.hide();
        this.urlFile.hide();
        // this.tambahLeafletAjax.attr('disabled',true);
        this.hapusLeafletAjax.attr('disabled',true);

        $('#LeafletAjax').click(function(){
            $('.PluginMenu').hide();
            $('#card-LeafletAjax').slideToggle('slow');
            // ControlLeafletAjax.addLayerLeafletAjax();
        })

        this.closeMenuLeafletAjax = $('#closeMenuLeafletAjax');

        this.LeafletAjaxLayer = [];
        this.csv = "";

        this.event();
    },
    remove: function(){
        this.command.remove();
    },
    getClassIcon: function(){
        return $('#LeafletAjax');
    },
    getClassIsi : function(){
        return $('#card-LeafletAjax');
    },
    event: function(){
        this.closeMenuLeafletAjax.click(function(){
            $('#card-LeafletAjax').slideToggle('slow');
        });

        this.urlFileLeafletAjax.change(function(){
            ControlLeafletAjax.tambahLeafletAjax.attr('disabled', false);
        });
        this.tambahLeafletAjax.click(function(){
            ControlLeafletAjax.addLayerLeafletAjax();
        });
        this.hapusLeafletAjax.click(function(){
            ControlLeafletAjax.removeLayerLeafletAjax();
        })
        this.fileCheckbox.change(function(){
            if(ControlLeafletAjax.fileCheckbox.prop("checked") == true){
                ControlLeafletAjax.urlFileLeafletAjax.show();
                ControlLeafletAjax.urlLeafletAjax.hide();
            }else{
                ControlLeafletAjax.urlFileLeafletAjax.hide();
                ControlLeafletAjax.urlLeafletAjax.show();
            }
        })
    },
    removeLayerLeafletAjax: function(){
        if(ControlLeafletAjax.LeafletAjaxLayer){
            for(var i in ControlLeafletAjax.LeafletAjaxLayer){
                map.eachLayer(function(layer){
                    var ly = ControlLeafletAjax.LeafletAjaxLayer[i];
                    if(layer._url == ly._url){
                        map.removeLayer(layer);
                    }
                })
            }
        }
        $.ajax({
            url: 'api/file/Remove',
            type: 'POST',              
            data: {url: this.urlFile.val()},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result)
            {
                ControlLeafletAjax.urlFile.val("");
                ControlLeafletAjax.urlLeafletAjax.val("");
                ControlLeafletAjax.urlFileLeafletAjax.val("");
                ControlLeafletAjax.hapusLeafletAjax.attr('disabled',true);
                ControlLeafletAjax.tambahLeafletAjax.attr('disabled', false);
            },
            error: function(data)
            {
                console.log(data);
            }
        });
    },
    addLayerLeafletAjax: function(){
        if(ControlLeafletAjax.fileCheckbox.prop("checked") == true){
            var u = this.urlFileLeafletAjax.prop('files')[0];
            var extend = u.name.split(".");
            if(extend[1] == "geojson" || extend[1] == "json" || extend[1] == "jsonp"){
                var formData = new FormData();
                formData.append('file',u);
                formData.append('url','leafletAjax/dokumen');
                
                $.ajax({
                    url: 'api/image/uploadImage',
                    type: 'POST',              
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result){
                        if(result.Message == "Berhasil"){
                            ControlLeafletAjax.urlFile.val("leafletAjax/dokumen/"+u.name);
                            ControlLeafletAjax.hapusLeafletAjax.attr('disabled',false);
                            ControlLeafletAjax.tambahLeafletAjax.attr('disabled', true);

                            var ajaxL = new L.GeoJSON.AJAX(ControlLeafletAjax.urlFile.val(),{onEachFeature:ControlLeafletAjax.popUp}).addTo(map);
                            var count = ControlFileGDB.size(ajaxL.getBounds());
                            if(count != 0){
                                map.fitBounds(ajaxL.getBounds());
                            }else{
                                alert("bounds are not valid");
                            }
                            ControlLeafletAjax.LeafletAjaxLayer.push(ajaxL);
                        }
                    },
                    error: function(data)
                    {
                        console.log(data);
                    }
                });
            }else{
                alert("Format tidak sesuai");
            }
        }else{
            var ajaxL = new L.GeoJSON.AJAX(ControlLeafletAjax.urlLeafletAjax.val(),{onEachFeature:ControlLeafletAjax.popUp}).addTo(map);
            var count = ControlFileGDB.size(ajaxL.getBounds());
            if(count != 0){
                map.fitBounds(ajaxL.getBounds());
            }else{
                alert("bounds are not valid");
            }
            ControlLeafletAjax.LeafletAjaxLayer.push(ajaxL);

            ControlLeafletAjax.hapusLeafletAjax.attr('disabled',false);
            ControlLeafletAjax.tambahLeafletAjax.attr('disabled', true);
        }
        
    },
    size : function(obj) {
        var size = 0, key;
        for (key in obj) {
            if (obj.hasOwnProperty(key)) size++;
        }
        return size;
    },popUp : function(f,l){
        var out = [];
        if (f.properties){
            for(key in f.properties){
                out.push(key+": "+f.properties[key]);
            }
            l.bindPopup(out.join("<br />"));
        }
    }
}