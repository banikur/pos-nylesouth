var command = L.control({position: 'topleft'});

command.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'command');
    div.innerHTML += '<a onclick="zoomIn();" title="Zoom In"><div id="zoomin"></div></a>\
            			<a onclick="zoomHome();" title="Beranda"><div id="backhome"></div></a>\
            			<a onclick="zoomOut();" title="Zoom Out"><div id="zoomout"></div></a>';
    return div;
};
// command.addTo(map);

function zoomIn(){
    map.setZoom(map.getZoom() + 1);
}

function zoomOut(){
    map.setZoom(map.getZoom() - 1);
}

function zoomHome(){
    map.setView([2.41627, 119.202148], 5);
}