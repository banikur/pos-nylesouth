var command = L.control({position: 'topright'});

command.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'command');
    div.innerHTML += '<a onclick="measures();" title="Info"><div id="measures"></div></a>';
    return div;
};
command.addTo(map);


function measures(){
	(function(L, document) {})(window.L, window.document);
}