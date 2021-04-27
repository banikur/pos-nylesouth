var WidgetDraw = {
	init : function(){
		this.formPoint = $('#form-point');
		this.icon = false;

		this.formPolyline = $('#form-polyline');
		this.path_polyline = $('#path_line');
		this.colorPolyline = $('#colorPolyline');
		this.opacityPolyline = $('#opacityPolyline');
		this.stylePolyline = $('#stylePolyline');
		this.widthPolyline = $('#widthPolyline');
		// this.offsetPolyline = $('#offsetPolyline');
		this.dasharray = "none";

		this.formPolygon = $('#form-polygon');
		this.outlineColor = $('#outlineColor');
		this.fillColor = $('#fillColor');
		this.outlineOpacity = $('#outlineOpacity');
		this.fillOpacity = $('#fillOpacity');
		this.outlineWidth = $('#outlineWidth');
		this.path_polygon = $('#path_polygon');
		
		this.menu = "";
	},
	openMenu: function(menu){
		this.clearMenu();
		if(menu == "polygon"){
			this.formPolygon.show();
		}else if(menu == "rectangle"){
			this.formPolygon.show();
		}else if(menu == "circle"){
			this.formPolygon.show();
		}else if(menu == "polyline"){
			this.formPolyline.show();
		}else if(menu == "point"){
			this.formPoint.show();
		}
		this.menu = menu;

		WidgetDraw.settingMenu();
	},
	clearMenu : function(){
		this.formPolygon.hide();
		this.formPolyline.hide();
		this.formPoint.hide();
	},
	settingMenu: function(){
		if(this.menu == "polygon" || this.menu == "rectangle" || this.menu == "circle"){
			this.path_polygon.attr('style',
				'fill: '+this.fillColor.val()+';'+
				'stroke: '+this.outlineColor.val()+';'+
				'stroke-width: '+this.outlineWidth.val()+';'+
				'fill-opacity: '+this.fillOpacity.val()/10+';'+
				'stroke-opacity: '+this.outlineOpacity.val()/10+';');
		}else if(this.menu == "polyline"){
			if(this.stylePolyline.val() == "STYLE_SOLID"){
				this.dasharray = "none";
			}else if(this.stylePolyline.val() == "STYLE_DASH"){
				this.dasharray = "28,21";
			}else if(this.stylePolyline.val() == "STYLE_DOT"){
				this.dasharray = "7,21";
			}else if(this.stylePolyline.val() == "STYLE_DASHDOT"){
				this.dasharray = "28,21,7,21";
			}
			this.path_polyline.attr('style',
				'stroke: '+this.colorPolyline.val()+';'+
				'stroke-dasharray: '+this.dasharray+';'+
				'stroke-width: '+this.widthPolyline.val()+';'+
				'stroke-opacity: '+this.opacityPolyline.val()/10+';'
			);
		}
	},
	settingInfo: function(menu){
		if(menu == "polygon"){
			$('#infoPath_polygon').attr('style',
				'fill: '+$("#infoFillColor").val()+';'+
				'stroke: '+$("#infoOutlineColor").val()+';'+
				'stroke-width: '+$("#infoOutlineWidth").val()+';'+
				'fill-opacity: '+$("#infoFillOpacity").val()/10+';'+
				'stroke-opacity: '+$("#infoOutlineOpacity").val()/10+';');
		}else if(menu == "polyline"){
			var dashArray = "";
			if($('#infoStylePolyline').val() == "STYLE_SOLID"){
				dashArray = "none";
			}else if($('#infoStylePolyline').val() == "STYLE_DASH"){
				dashArray = "28,21";
			}else if($('#infoStylePolyline').val() == "STYLE_DOT"){
				dashArray = "7,21";
			}else if($('#infoStylePolyline').val() == "STYLE_DASHDOT"){
				dashArray = "28,21,7,21";
			}

			$('#infoPath_line').attr('style',
				'stroke: '+$('#infoColorPolyline').val()+';'+
				'stroke-dasharray: '+dashArray+';'+
				'stroke-width: '+$('#infoWidthPolyline').val()+';'+
				'stroke-opacity: '+$('#infoOpacityPolyline').val()/10+';'
			);
		}
	},
	drawing: function(){
		if(this.menu == "polygon"){
			var property = {
				color 		: this.outlineColor.val(),
				weight 		: this.outlineWidth.val(),
				opacity 	: this.outlineOpacity.val()/10,
				fillColor 	: this.fillColor.val(),
				fillOpacity : this.fillOpacity.val()/10
			}
			ObjectControl.Polygon.Draw(property);
		}else if(this.menu == "rectangle"){
			var property = {
				color 		: this.outlineColor.val(),
				weight 		: this.outlineWidth.val(),
				opacity 	: this.outlineOpacity.val()/10,
				fillColor 	: this.fillColor.val(),
				fillOpacity : this.fillOpacity.val()/10
			}
			ObjectControl.Rectangle.Draw(property);
		}else if(this.menu == "circle"){
			var property = {
				color 		: this.outlineColor.val(),
				weight 		: this.outlineWidth.val(),
				opacity 	: this.outlineOpacity.val()/10,
				fillColor 	: this.fillColor.val(),
				fillOpacity : this.fillOpacity.val()/10
			}
			ObjectControl.Circle.Draw(property);
		}else if(this.menu == "polyline"){
			var property = {
				color 			: this.colorPolyline.val(),
				dashArray 		: this.dasharray,
				weight 			: this.widthPolyline.val(),
				opacity 		: this.opacityPolyline.val()/10,
				// offset 			: this.offsetPolyline.val(),
				// distanceMarkers : this.distanceMarkers,
				// text 			: this.keterangan
			};
			ObjectControl.Polyline.Draw(property);
		}else if(this.menu == "point"){
			var type = $('#typeIcon').val();
			if(type == "default"){
				ObjectControl.Marker.Draw();
			}else{
				if(this.icon){
					var prop = {
						icon : this.icon
					}
					ObjectControl.Marker.Draw(prop);
				}else{
					swal('Warning','Please select Icon','warning');
				}
			}
		}else{
			alert('Please select draw mode')
		}
	},
	formWIUP : function(prop){
		var object = {};
		if(prop.informasi){
			object = {
				npwp 		: (prop.informasi.npwp) ? prop.informasi.npwp : "-",
				pulau 		: (prop.informasi.pulau) ? prop.informasi.pulau : "-",
				nama_prov 	: (prop.informasi.nama_prov) ? prop.informasi.nama_prov : "-",
				nama_kab 	: (prop.informasi.nama_kab) ? prop.informasi.nama_kab : "-",
				lokasi 		: (prop.informasi.lokasi) ? prop.informasi.lokasi : "-",
				pejabat 	: (prop.informasi.pejabat) ? prop.informasi.pejabat : "-",
				badan_usaha : (prop.informasi.badan_usaha) ? prop.informasi.badan_usaha : "-",
				nama_usaha 	: (prop.informasi.nama_usaha) ? prop.informasi.nama_usaha : "-",
				dirut_usaha : (prop.informasi.dirut_usaha) ? prop.informasi.dirut_usaha : "-",
				alamat_usaha: (prop.informasi.alamat_usaha) ? prop.informasi.alamat_usaha : "-",
				telepon_usaha: (prop.informasi.telepon_usaha) ? prop.informasi.telepon_usaha : "-",
				fax_usaha 	: (prop.informasi.fax_usaha) ? prop.informasi.fax_usaha : "-",
				sk_iup 		: (prop.informasi.sk_iup) ? prop.informasi.sk_iup : "-",
				tgl_berlaku	: (prop.informasi.tgl_berlaku) ? prop.informasi.tgl_berlaku : "-",
				tgl_akhir 	: (prop.informasi.tgl_akhir) ? prop.informasi.tgl_akhir : "-",
				kegiatan 	: (prop.informasi.kegiatan) ? prop.informasi.kegiatan : "-",
				jenis_izin 	: (prop.informasi.jenis_izin) ? prop.informasi.jenis_izin : "-",
				luas_sk 	: (prop.informasi.luas_sk) ? prop.informasi.luas_sk : "-",
				luas_style 	: (prop.informasi.luas_style) ? prop.informasi.luas_style : "-",
				cnc 		: (prop.informasi.cnc) ? prop.informasi.cnc : "-",
				catatan 	: (prop.informasi.catatan) ? prop.informasi.catatan : "-",
				verifikasi 	: (prop.informasi.verifikasi) ? prop.informasi.verifikasi : "-",
				komoditas 	: (prop.informasi.komoditas) ? prop.informasi.komoditas : "-",
				creator 	: (prop.informasi.creator) ? prop.informasi.creator : "-",
				editor 		: (prop.informasi.editor) ? prop.informasi.editor : "-",
			}
		}else{
			object = {
				npwp 		: "-",pulau 		: "-",nama_prov 	: "-",nama_kab 		: "-",lokasi 		: "-",
				pejabat 	: "-",badan_usaha 	: "-",nama_usaha 	: "-",dirut_usaha 	: "-",alamat_usaha 	: "-",
				telepon_usaha: "-",fax_usaha 	: "-",sk_iup 		: "-",tgl_berlaku 	: "-",tgl_akhir 	: "-",
				kegiatan 	: "-",jenis_izin 	: "-",luas_sk 		: "-",luas_style 	: "-",cnc 			: "-",
				catatan 	: "-",verifikasi 	: "-",komoditas 	: "-",creator 		: "-",editor 		: "-",
			}
		}
		return object;
	}
}
WidgetDraw.init();
ObjectControl.getFeatureGroup().on("click",function(evt){
	var layer = evt.layer;
	openMenu();
	if(layer instanceof L.Polygon || layer instanceof L.Circle){
		var prop 		= ObjectControl.getProperty(layer);
		var form 		= WidgetDraw.formWIUP(prop);

		$('#modal-infoPolyline').modal('hide');
		$('#modal-infoPoint').modal('hide');
		$('#modal-infoPolygon').modal('show');
		$('#infoKode_wiup').html((ObjectControl.getID(layer)) ? ObjectControl.getID(layer) : "-");
		
		$('#infoNPWP').html(":&nbsp;"+form.npwp);
		$('#infoPulau').html(":&nbsp;"+form.pulau);
		$('#infoNama_prov').html(":&nbsp;"+form.nama_prov);
		$('#infoNama_kab').html(":&nbsp;"+form.nama_kab);
		$('#infoLokasi').html(":&nbsp;"+form.lokasi);
		$('#infoPejabat').html(":&nbsp;"+form.pejabat);
		$('#infoBadan_usaha').html(":&nbsp;"+form.badan_usaha);
		$('#infoNama_usaha').html(":&nbsp;"+form.nama_usaha);
		$('#infoDirut_usah').html(":&nbsp;"+form.dirut_usaha);
		$('#infoAlamat_usa').html(":&nbsp;"+form.alamat_usaha);
		$('#infoTelepon_us').html(":&nbsp;"+form.telepon_usaha);
		$('#infoFax_usaha').html(":&nbsp;"+form.fax_usaha);
		$('#infoSk_iup').html(":&nbsp;"+form.sk_iup);
		$('#infoTgl_berlak').html(":&nbsp;"+form.tgl_berlaku);
		$('#infoTgl_akhir').html(":&nbsp;"+form.tgl_akhir);
		$('#infoKegiatan').html(":&nbsp;"+form.kegiatan);
		$('#infoJenis_izin').html(":&nbsp;"+form.jenis_izin);
		$('#infoLuas_sk').html(":&nbsp;"+form.luas_sk);
		$('#infoLuas_style').html(":&nbsp;"+form.luas_style);
		$('#infoCnc').html(":&nbsp;"+form.cnc);
		$('#infoCatatan').html(":&nbsp;"+form.catatan);
		$('#infoVerifikasi').html(":&nbsp;"+form.verifikasi);
		$('#infoKomoditas').html(":&nbsp;"+form.komoditas);
		$('#infoCreator').html(":&nbsp;"+form.creator);
		$('#infoEditor').html(":&nbsp;"+form.editor);
		let html = '';
		let alasan = '';
		let destroy = false;
		if(prop.data.kode_wiup){
			if(prop.data.status == 0){
				html += '<span>\
							<button onclick="verifikasiData(0,'+prop.data.id_perusahaan+','+prop.data.id_pengajuan+')" type="button" class="btn btn-outline-success btn-sm mr-2" title="Iya">\
								<i class="fa fa-check" aria-hidden="true"></i>\
							</button>\
							<button onclick="verifikasiData(1,'+prop.data.id_perusahaan+','+prop.data.id_pengajuan+')" type="button" class="btn btn-outline-danger btn-sm mr-2" title="Tolak">\
								<i class="fa fa-times" aria-hidden="true"></i>\
							</button>\
						</span>';
			}else if(prop.data.status == 1){
				destroy = true;
				html += '<span>\
							<span class="badge badge-success">Disetujui</span>\
						</span>';
			}else if(prop.data.status == 2){
				destroy = true;
				html += '<span>\
							<span class="badge badge-danger">Ditolak</span>\
						</span>';
				alasan += '<span>\
								alasan : '+prop.data.keterangan+'\
							</span>';
			}
		}else{
			html += '<span>\
						<button onclick="verifikasiData(2,'+prop.data.id_perusahaan+','+prop.data.id_pengajuan+')" type="button" class="btn btn-outline-success btn-sm mr-2">\
							Tambah WIUP\
						</button>\
					</span>';
			
		}
		html += '<span>';
		if(destroy){
			html += '<button onclick="verifikasiData(3,'+prop.data.id_perusahaan+','+prop.data.id_pengajuan+')" type="button" class="btn btn-outline-danger btn-sm" title="Delete">\
						<i class="fa fa-trash" aria-hidden="true"></i>\
					</button>';
		}
		html += '</span>';
		// $('#verifikasiInfoPolygon').html(html);
		// $('#alasanInfoPolygon').html(alasan);

	}else if(layer instanceof L.Polyline){
		var prop 		= ObjectControl.getProperty(layer);
		var style = "";
		if(prop.dashArray == "none"){
			style = "STYLE_SOLID";
		}else if(prop.dashArray == "28,21"){
			style = "STYLE_DASH";
		}else if(prop.dashArray == "7,21"){
			style = "STYLE_DOT";
		}else if(prop.dashArray == "28,21,7,21"){
			style = "STYLE_DASHDOT";
		}

		$('#infoKodePolyline').html(prop.uniqueID);
		$('#infoColorPolyline').val(prop.color);
		$('#infoOpacityPolyline').val(Number(prop.opacity) * 10);
		$('#infoStylePolyline').val(style);
		$('#infoWidthPolyline').val(prop.weight);

		WidgetDraw.settingInfo('polyline');
		$('#modal-infoPolygon').modal('hide');
		$('#modal-infoPoint').modal('hide');
		$('#modal-infoPolyline').modal('show');
	}else if(layer instanceof L.Marker){
		var prop = ObjectControl.getProperty(layer);
		
		$('#infoKodePoint').html(prop.uniqueID);

		$('#modal-infoPolygon').modal('hide');
		$('#modal-infoPolyline').modal('hide');
		$('#modal-infoPoint').modal('show');
	}
});