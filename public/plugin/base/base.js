// var labelTextCollision = new L.LabelTextCollision({
//     collisionFlg : true
// });
var map = L.map('map',
		{
			// minZoom: 5,
            maxZoom: 19,
            editable: true,
            zoomControl:false,
            renderer : false
            // crs: L.CRS.EPSG4326
		}
).setView([2.41627, 119.202148], 5);