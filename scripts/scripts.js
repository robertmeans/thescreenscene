// JavaScript Document
setTimeout(function() {
  $("#success-wrap").fadeOut(750);
}, 500);

// Modal inspiration came from:
// https://www.w3schools.com/howto/howto_css_modals.asp
// rewritten in a for loop in project forlder at: _code_snippets/edit-modal-function.php
var modal_01=document.getElementById("modal_01"),modal_02=document.getElementById("modal_02"),modal_03=document.getElementById("modal_03"),modal_04=document.getElementById("modal_04"),modal_05=document.getElementById("modal_05"),modal_06=document.getElementById("modal_06"),modal_07=document.getElementById("modal_07"),modal_08=document.getElementById("modal_08"),modal_09=document.getElementById("modal_09"),modal_10=document.getElementById("modal_10"),modal_11=document.getElementById("modal_11"),modal_12=document.getElementById("modal_12"),modal_13=document.getElementById("modal_13"),modal_14=document.getElementById("modal_14"),modal_15=document.getElementById("modal_15"),modal_16=document.getElementById("modal_16"),modal_17=document.getElementById("modal_17"),modal_18=document.getElementById("modal_18"),modal_19=document.getElementById("modal_19"),modal_20=document.getElementById("modal_20"),modal_21=document.getElementById("modal_21"),modal_22=document.getElementById("modal_22"),modal_23=document.getElementById("modal_23"),modal_24=document.getElementById("modal_24"),modal_25=document.getElementById("modal_25"),modal_26=document.getElementById("modal_26"),modal_27=document.getElementById("modal_27"),modal_28=document.getElementById("modal_28"),modal_29=document.getElementById("modal_29"),modal_30=document.getElementById("modal_30"),modal_31=document.getElementById("modal_31"),modal_32=document.getElementById("modal_32"),modal_33=document.getElementById("modal_33"),modal_34=document.getElementById("modal_34"),modal_35=document.getElementById("modal_35"),modal_36=document.getElementById("modal_36"),modal_37=document.getElementById("modal_37"),modal_38=document.getElementById("modal_38"),modal_39=document.getElementById("modal_39"),modal_40=document.getElementById("modal_40"),modal_41=document.getElementById("modal_41"),modal_42=document.getElementById("modal_42"),modal_43=document.getElementById("modal_43"),modal_44=document.getElementById("modal_44"),modal_45=document.getElementById("modal_45"),modal_46=document.getElementById("modal_46"),modal_47=document.getElementById("modal_47"),modal_48=document.getElementById("modal_48"),modal_49=document.getElementById("modal_49"),modal_50=document.getElementById("modal_50"),modal_51=document.getElementById("modal_51"),modal_52=document.getElementById("modal_52"),modal_53=document.getElementById("modal_53"),modal_54=document.getElementById("modal_54"),modal_55=document.getElementById("modal_55"),modal_56=document.getElementById("modal_56"),modal_57=document.getElementById("modal_57"),modal_58=document.getElementById("modal_58"),modal_59=document.getElementById("modal_59"),modal_60=document.getElementById("modal_60"),modal_61=document.getElementById("modal_61"),modal_62=document.getElementById("modal_62"),modal_63=document.getElementById("modal_63"),modal_64=document.getElementById("modal_64"),modal_65=document.getElementById("modal_65"),modal_66=document.getElementById("modal_66"),modal_67=document.getElementById("modal_67"),modal_68=document.getElementById("modal_68"),modal_69=document.getElementById("modal_69"),modal_70=document.getElementById("modal_70"),modal_71=document.getElementById("modal_71"),modal_72=document.getElementById("modal_72"),btn_01=document.getElementById("open_modal_01"),btn_02=document.getElementById("open_modal_02"),btn_03=document.getElementById("open_modal_03"),btn_04=document.getElementById("open_modal_04"),btn_05=document.getElementById("open_modal_05"),btn_06=document.getElementById("open_modal_06"),btn_07=document.getElementById("open_modal_07"),btn_08=document.getElementById("open_modal_08"),btn_09=document.getElementById("open_modal_09"),btn_10=document.getElementById("open_modal_10"),btn_11=document.getElementById("open_modal_11"),btn_12=document.getElementById("open_modal_12"),btn_13=document.getElementById("open_modal_13"),btn_14=document.getElementById("open_modal_14"),btn_15=document.getElementById("open_modal_15"),btn_16=document.getElementById("open_modal_16"),btn_17=document.getElementById("open_modal_17"),btn_18=document.getElementById("open_modal_18"),btn_19=document.getElementById("open_modal_19"),btn_20=document.getElementById("open_modal_20"),btn_21=document.getElementById("open_modal_21"),btn_22=document.getElementById("open_modal_22"),btn_23=document.getElementById("open_modal_23"),btn_24=document.getElementById("open_modal_24"),btn_25=document.getElementById("open_modal_25"),btn_26=document.getElementById("open_modal_26"),btn_27=document.getElementById("open_modal_27"),btn_28=document.getElementById("open_modal_28"),btn_29=document.getElementById("open_modal_29"),btn_30=document.getElementById("open_modal_30"),btn_31=document.getElementById("open_modal_31"),btn_32=document.getElementById("open_modal_32"),btn_33=document.getElementById("open_modal_33"),btn_34=document.getElementById("open_modal_34"),btn_35=document.getElementById("open_modal_35"),btn_36=document.getElementById("open_modal_36"),btn_37=document.getElementById("open_modal_37"),btn_38=document.getElementById("open_modal_38"),btn_39=document.getElementById("open_modal_39"),btn_40=document.getElementById("open_modal_40"),btn_41=document.getElementById("open_modal_41"),btn_42=document.getElementById("open_modal_42"),btn_43=document.getElementById("open_modal_43"),btn_44=document.getElementById("open_modal_44"),btn_45=document.getElementById("open_modal_45"),btn_46=document.getElementById("open_modal_46"),btn_47=document.getElementById("open_modal_47"),btn_48=document.getElementById("open_modal_48"),btn_49=document.getElementById("open_modal_49"),btn_50=document.getElementById("open_modal_50"),btn_51=document.getElementById("open_modal_51"),btn_52=document.getElementById("open_modal_52"),btn_53=document.getElementById("open_modal_53"),btn_54=document.getElementById("open_modal_54"),btn_55=document.getElementById("open_modal_55"),btn_56=document.getElementById("open_modal_56"),btn_57=document.getElementById("open_modal_57"),btn_58=document.getElementById("open_modal_58"),btn_59=document.getElementById("open_modal_59"),btn_60=document.getElementById("open_modal_60"),btn_61=document.getElementById("open_modal_61"),btn_62=document.getElementById("open_modal_62"),btn_63=document.getElementById("open_modal_63"),btn_64=document.getElementById("open_modal_64"),btn_65=document.getElementById("open_modal_65"),btn_66=document.getElementById("open_modal_66"),btn_67=document.getElementById("open_modal_67"),btn_68=document.getElementById("open_modal_68"),btn_69=document.getElementById("open_modal_69"),btn_70=document.getElementById("open_modal_70"),btn_71=document.getElementById("open_modal_71"),btn_72=document.getElementById("open_modal_72"),span=document.getElementsByClassName("close");window.addEventListener("load",function(){btn_01.onclick=function(){modal_01.style.display="block"},btn_02.onclick=function(){modal_02.style.display="block"},btn_03.onclick=function(){modal_03.style.display="block"},btn_04.onclick=function(){modal_04.style.display="block"},btn_05.onclick=function(){modal_05.style.display="block"},btn_06.onclick=function(){modal_06.style.display="block"},btn_07.onclick=function(){modal_07.style.display="block"},btn_08.onclick=function(){modal_08.style.display="block"},btn_09.onclick=function(){modal_09.style.display="block"},btn_10.onclick=function(){modal_10.style.display="block"},btn_11.onclick=function(){modal_11.style.display="block"},btn_12.onclick=function(){modal_12.style.display="block"},btn_13.onclick=function(){modal_13.style.display="block"},btn_14.onclick=function(){modal_14.style.display="block"},btn_15.onclick=function(){modal_15.style.display="block"},btn_16.onclick=function(){modal_16.style.display="block"},btn_17.onclick=function(){modal_17.style.display="block"},btn_18.onclick=function(){modal_18.style.display="block"},btn_19.onclick=function(){modal_19.style.display="block"},btn_20.onclick=function(){modal_20.style.display="block"},btn_21.onclick=function(){modal_21.style.display="block"},btn_22.onclick=function(){modal_22.style.display="block"},btn_23.onclick=function(){modal_23.style.display="block"},btn_24.onclick=function(){modal_24.style.display="block"},btn_25.onclick=function(){modal_25.style.display="block"},btn_26.onclick=function(){modal_26.style.display="block"},btn_27.onclick=function(){modal_27.style.display="block"},btn_28.onclick=function(){modal_28.style.display="block"},btn_29.onclick=function(){modal_29.style.display="block"},btn_30.onclick=function(){modal_30.style.display="block"},btn_31.onclick=function(){modal_31.style.display="block"},btn_32.onclick=function(){modal_32.style.display="block"},btn_33.onclick=function(){modal_33.style.display="block"},btn_34.onclick=function(){modal_34.style.display="block"},btn_35.onclick=function(){modal_35.style.display="block"},btn_36.onclick=function(){modal_36.style.display="block"},btn_37.onclick=function(){modal_37.style.display="block"},btn_38.onclick=function(){modal_38.style.display="block"},btn_39.onclick=function(){modal_39.style.display="block"},btn_40.onclick=function(){modal_40.style.display="block"},btn_41.onclick=function(){modal_41.style.display="block"},btn_42.onclick=function(){modal_42.style.display="block"},btn_43.onclick=function(){modal_43.style.display="block"},btn_44.onclick=function(){modal_44.style.display="block"},btn_45.onclick=function(){modal_45.style.display="block"},btn_46.onclick=function(){modal_46.style.display="block"},btn_47.onclick=function(){modal_47.style.display="block"},btn_48.onclick=function(){modal_48.style.display="block"},btn_49.onclick=function(){modal_49.style.display="block"},btn_50.onclick=function(){modal_50.style.display="block"},btn_51.onclick=function(){modal_51.style.display="block"},btn_52.onclick=function(){modal_52.style.display="block"},btn_53.onclick=function(){modal_53.style.display="block"},btn_54.onclick=function(){modal_54.style.display="block"},btn_55.onclick=function(){modal_55.style.display="block"},btn_56.onclick=function(){modal_56.style.display="block"},btn_57.onclick=function(){modal_57.style.display="block"},btn_58.onclick=function(){modal_58.style.display="block"},btn_59.onclick=function(){modal_59.style.display="block"},btn_60.onclick=function(){modal_60.style.display="block"},btn_61.onclick=function(){modal_61.style.display="block"},btn_62.onclick=function(){modal_62.style.display="block"},btn_63.onclick=function(){modal_63.style.display="block"},btn_64.onclick=function(){modal_64.style.display="block"},btn_65.onclick=function(){modal_65.style.display="block"},btn_66.onclick=function(){modal_66.style.display="block"},btn_67.onclick=function(){modal_67.style.display="block"},btn_68.onclick=function(){modal_68.style.display="block"},btn_69.onclick=function(){modal_69.style.display="block"},btn_70.onclick=function(){modal_70.style.display="block"},btn_71.onclick=function(){modal_71.style.display="block"},btn_72.onclick=function(){modal_72.style.display="block"};for(var l=0;l<span.length;l++)span[l].onclick=function(){modal_01.style.display="none",modal_02.style.display="none",modal_03.style.display="none",modal_04.style.display="none",modal_05.style.display="none",modal_06.style.display="none",modal_07.style.display="none",modal_08.style.display="none",modal_09.style.display="none",modal_10.style.display="none",modal_11.style.display="none",modal_12.style.display="none",modal_13.style.display="none",modal_14.style.display="none",modal_15.style.display="none",modal_16.style.display="none",modal_17.style.display="none",modal_18.style.display="none",modal_19.style.display="none",modal_20.style.display="none",modal_21.style.display="none",modal_22.style.display="none",modal_23.style.display="none",modal_24.style.display="none",modal_25.style.display="none",modal_26.style.display="none",modal_27.style.display="none",modal_28.style.display="none",modal_29.style.display="none",modal_30.style.display="none",modal_31.style.display="none",modal_32.style.display="none",modal_33.style.display="none",modal_34.style.display="none",modal_35.style.display="none",modal_36.style.display="none",modal_37.style.display="none",modal_38.style.display="none",modal_39.style.display="none",modal_40.style.display="none",modal_41.style.display="none",modal_42.style.display="none",modal_43.style.display="none",modal_44.style.display="none",modal_45.style.display="none",modal_46.style.display="none",modal_47.style.display="none",modal_48.style.display="none",modal_49.style.display="none",modal_50.style.display="none",modal_51.style.display="none",modal_52.style.display="none",modal_53.style.display="none",modal_54.style.display="none",modal_55.style.display="none",modal_56.style.display="none",modal_57.style.display="none",modal_58.style.display="none",modal_59.style.display="none",modal_60.style.display="none",modal_61.style.display="none",modal_62.style.display="none",modal_63.style.display="none",modal_64.style.display="none",modal_65.style.display="none",modal_66.style.display="none",modal_67.style.display="none",modal_68.style.display="none",modal_69.style.display="none",modal_70.style.display="none",modal_71.style.display="none",modal_72.style.display="none"};window.onmousedown=function(l){l.target!=modal_01&&l.target!=modal_02&&l.target!=modal_03&&l.target!=modal_04&&l.target!=modal_05&&l.target!=modal_06&&l.target!=modal_07&&l.target!=modal_08&&l.target!=modal_09&&l.target!=modal_10&&l.target!=modal_11&&l.target!=modal_12&&l.target!=modal_13&&l.target!=modal_14&&l.target!=modal_15&&l.target!=modal_16&&l.target!=modal_17&&l.target!=modal_18&&l.target!=modal_19&&l.target!=modal_20&&l.target!=modal_21&&l.target!=modal_22&&l.target!=modal_23&&l.target!=modal_24&&l.target!=modal_25&&l.target!=modal_26&&l.target!=modal_27&&l.target!=modal_28&&l.target!=modal_29&&l.target!=modal_30&&l.target!=modal_31&&l.target!=modal_32&&l.target!=modal_33&&l.target!=modal_34&&l.target!=modal_35&&l.target!=modal_36&&l.target!=modal_37&&l.target!=modal_38&&l.target!=modal_39&&l.target!=modal_40&&l.target!=modal_41&&l.target!=modal_42&&l.target!=modal_43&&l.target!=modal_44&&l.target!=modal_45&&l.target!=modal_46&&l.target!=modal_47&&l.target!=modal_48&&l.target!=modal_49&&l.target!=modal_50&&l.target!=modal_51&&l.target!=modal_52&&l.target!=modal_53&&l.target!=modal_54&&l.target!=modal_55&&l.target!=modal_56&&l.target!=modal_57&&l.target!=modal_58&&l.target!=modal_59&&l.target!=modal_60&&l.target!=modal_61&&l.target!=modal_62&&l.target!=modal_63&&l.target!=modal_64&&l.target!=modal_65&&l.target!=modal_66&&l.target!=modal_67&&l.target!=modal_68&&l.target!=modal_69&&l.target!=modal_70&&l.target!=modal_71&&l.target!=modal_72||(modal_01.style.display="none",modal_02.style.display="none",modal_03.style.display="none",modal_04.style.display="none",modal_05.style.display="none",modal_06.style.display="none",modal_07.style.display="none",modal_08.style.display="none",modal_09.style.display="none",modal_10.style.display="none",modal_11.style.display="none",modal_12.style.display="none",modal_13.style.display="none",modal_14.style.display="none",modal_15.style.display="none",modal_16.style.display="none",modal_17.style.display="none",modal_18.style.display="none",modal_19.style.display="none",modal_20.style.display="none",modal_21.style.display="none",modal_22.style.display="none",modal_23.style.display="none",modal_24.style.display="none",modal_25.style.display="none",modal_26.style.display="none",modal_27.style.display="none",modal_28.style.display="none",modal_29.style.display="none",modal_30.style.display="none",modal_31.style.display="none",modal_32.style.display="none",modal_33.style.display="none",modal_34.style.display="none",modal_35.style.display="none",modal_36.style.display="none",modal_37.style.display="none",modal_38.style.display="none",modal_39.style.display="none",modal_40.style.display="none",modal_41.style.display="none",modal_42.style.display="none",modal_43.style.display="none",modal_44.style.display="none",modal_45.style.display="none",modal_46.style.display="none",modal_47.style.display="none",modal_48.style.display="none",modal_49.style.display="none",modal_50.style.display="none",modal_51.style.display="none",modal_52.style.display="none",modal_53.style.display="none",modal_54.style.display="none",modal_55.style.display="none",modal_56.style.display="none",modal_57.style.display="none",modal_58.style.display="none",modal_59.style.display="none",modal_60.style.display="none",modal_61.style.display="none",modal_62.style.display="none",modal_63.style.display="none",modal_64.style.display="none",modal_65.style.display="none",modal_66.style.display="none",modal_67.style.display="none",modal_68.style.display="none",modal_69.style.display="none",modal_70.style.display="none",modal_71.style.display="none",modal_72.style.display="none")}});

// end modal
// add a note | add-a-note
var modal_aan = document.getElementById("aan-modal");
var btn_aan = document.getElementById("add-note");
var span_aan = document.getElementsByClassName("aan-close")[0];
var a_aan = document.getElementsByClassName("cancel-close")[0];

window.addEventListener("load", function(){
	btn_aan.onclick = function() {
	  modal_aan.style.display = "block";
	}
	span_aan.onclick = function() {
	  modal_aan.style.display = "none";
	}
	a_aan.onclick = function() {
	  modal_aan.style.display = "none";
	}
	window.onmousedown = function(event) {
	  if (event.target == modal_aan) {
	    modal_aan.style.display = "none";
	  }
	}
});
// end add a note

// modify a note | modify-a-note
// **** Whoever is at the bottom with the window.addEventListener function is the only one that is 
// letting a mouse click outside the modal close it. maybe put all the onmousedown events into last function?
if(null!==document.getElementById("01_modify-modal"))var note_01=document.getElementById("01_modify-modal");if(null!==document.getElementById("02_modify-modal"))var note_02=document.getElementById("02_modify-modal");if(null!==document.getElementById("03_modify-modal"))var note_03=document.getElementById("03_modify-modal");if(null!==document.getElementById("04_modify-modal"))var note_04=document.getElementById("04_modify-modal");if(null!==document.getElementById("05_modify-modal"))var note_05=document.getElementById("05_modify-modal");if(null!==document.getElementById("06_modify-modal"))var note_06=document.getElementById("06_modify-modal");if(null!==document.getElementById("07_modify-modal"))var note_07=document.getElementById("07_modify-modal");if(null!==document.getElementById("08_modify-modal"))var note_08=document.getElementById("08_modify-modal");if(null!==document.getElementById("09_modify-modal"))var note_09=document.getElementById("09_modify-modal");if(null!==document.getElementById("10_modify-modal"))var note_10=document.getElementById("10_modify-modal");if(null!==document.getElementById("11_modify-modal"))var note_11=document.getElementById("11_modify-modal");if(null!==document.getElementById("12_modify-modal"))var note_12=document.getElementById("12_modify-modal");if(null!==document.getElementById("13_modify-modal"))var note_13=document.getElementById("13_modify-modal");if(null!==document.getElementById("14_modify-modal"))var note_14=document.getElementById("14_modify-modal");if(null!==document.getElementById("15_modify-modal"))var note_15=document.getElementById("15_modify-modal");if(null!==document.getElementById("16_modify-modal"))var note_16=document.getElementById("16_modify-modal");if(null!==document.getElementById("17_modify-modal"))var note_17=document.getElementById("17_modify-modal");if(null!==document.getElementById("18_modify-modal"))var note_18=document.getElementById("18_modify-modal");if(null!==document.getElementById("19_modify-modal"))var note_19=document.getElementById("19_modify-modal");if(null!==document.getElementById("20_modify-modal"))var note_20=document.getElementById("20_modify-modal");if(null!==document.getElementById("01_modify-note"))var note_btn_01=document.getElementById("01_modify-note");if(null!==document.getElementById("02_modify-note"))var note_btn_02=document.getElementById("02_modify-note");if(null!==document.getElementById("03_modify-note"))var note_btn_03=document.getElementById("03_modify-note");if(null!==document.getElementById("04_modify-note"))var note_btn_04=document.getElementById("04_modify-note");if(null!==document.getElementById("05_modify-note"))var note_btn_05=document.getElementById("05_modify-note");if(null!==document.getElementById("06_modify-note"))var note_btn_06=document.getElementById("06_modify-note");if(null!==document.getElementById("07_modify-note"))var note_btn_07=document.getElementById("07_modify-note");if(null!==document.getElementById("08_modify-note"))var note_btn_08=document.getElementById("08_modify-note");if(null!==document.getElementById("09_modify-note"))var note_btn_09=document.getElementById("09_modify-note");if(null!==document.getElementById("10_modify-note"))var note_btn_10=document.getElementById("10_modify-note");if(null!==document.getElementById("11_modify-note"))var note_btn_11=document.getElementById("11_modify-note");if(null!==document.getElementById("12_modify-note"))var note_btn_12=document.getElementById("12_modify-note");if(null!==document.getElementById("13_modify-note"))var note_btn_13=document.getElementById("13_modify-note");if(null!==document.getElementById("14_modify-note"))var note_btn_14=document.getElementById("14_modify-note");if(null!==document.getElementById("15_modify-note"))var note_btn_15=document.getElementById("15_modify-note");if(null!==document.getElementById("16_modify-note"))var note_btn_16=document.getElementById("16_modify-note");if(null!==document.getElementById("17_modify-note"))var note_btn_17=document.getElementById("17_modify-note");if(null!==document.getElementById("18_modify-note"))var note_btn_18=document.getElementById("18_modify-note");if(null!==document.getElementById("19_modify-note"))var note_btn_19=document.getElementById("19_modify-note");if(null!==document.getElementById("20_modify-note"))var note_btn_20=document.getElementById("20_modify-note");var spanz=document.getElementsByClassName("closer");window.addEventListener("load",function(){null!=note_01&&(note_btn_01.onclick=function(){note_01.style.display="block"}),null!=note_02&&(note_btn_02.onclick=function(){note_02.style.display="block"}),null!=note_03&&(note_btn_03.onclick=function(){note_03.style.display="block"}),null!=note_04&&(note_btn_04.onclick=function(){note_04.style.display="block"}),null!=note_05&&(note_btn_05.onclick=function(){note_05.style.display="block"}),null!=note_06&&(note_btn_06.onclick=function(){note_06.style.display="block"}),null!=note_07&&(note_btn_07.onclick=function(){note_07.style.display="block"}),null!=note_08&&(note_btn_08.onclick=function(){note_08.style.display="block"}),null!=note_09&&(note_btn_09.onclick=function(){note_09.style.display="block"}),null!=note_10&&(note_btn_10.onclick=function(){note_10.style.display="block"}),null!=note_11&&(note_btn_11.onclick=function(){note_11.style.display="block"}),null!=note_12&&(note_btn_12.onclick=function(){note_12.style.display="block"}),null!=note_13&&(note_btn_13.onclick=function(){note_13.style.display="block"}),null!=note_14&&(note_btn_14.onclick=function(){note_14.style.display="block"}),null!=note_15&&(note_btn_15.onclick=function(){note_15.style.display="block"}),null!=note_16&&(note_btn_16.onclick=function(){note_16.style.display="block"}),null!=note_17&&(note_btn_17.onclick=function(){note_17.style.display="block"}),null!=note_18&&(note_btn_18.onclick=function(){note_18.style.display="block"}),null!=note_19&&(note_btn_19.onclick=function(){note_19.style.display="block"}),null!=note_20&&(note_btn_20.onclick=function(){note_20.style.display="block"});for(var e=0;e<spanz.length;e++)spanz[e].onclick=function(){null!=note_01&&(note_01.style.display="none"),null!=note_02&&(note_02.style.display="none"),null!=note_03&&(note_03.style.display="none"),null!=note_04&&(note_04.style.display="none"),null!=note_05&&(note_05.style.display="none"),null!=note_06&&(note_06.style.display="none"),null!=note_07&&(note_07.style.display="none"),null!=note_08&&(note_08.style.display="none"),null!=note_09&&(note_09.style.display="none"),null!=note_10&&(note_10.style.display="none"),null!=note_11&&(note_11.style.display="none"),null!=note_12&&(note_12.style.display="none"),null!=note_13&&(note_13.style.display="none"),null!=note_14&&(note_14.style.display="none"),null!=note_15&&(note_15.style.display="none"),null!=note_16&&(note_16.style.display="none"),null!=note_17&&(note_17.style.display="none"),null!=note_18&&(note_18.style.display="none"),null!=note_19&&(note_19.style.display="none"),null!=note_20&&(note_20.style.display="none")};window.onmousedown=function(e){e.target!=note_01&&e.target!=note_02&&e.target!=note_03&&e.target!=note_04&&e.target!=note_05&&e.target!=note_06&&e.target!=note_07&&e.target!=note_08&&e.target!=note_09&&e.target!=note_10&&e.target!=note_11&&e.target!=note_12&&e.target!=note_13&&e.target!=note_14&&e.target!=note_15&&e.target!=note_16&&e.target!=note_17&&e.target!=note_18&&e.target!=note_19&&e.target!=note_20||(note_01.style.display="none",note_02.style.display="none",note_03.style.display="none",note_04.style.display="none",note_05.style.display="none",note_06.style.display="none",note_07.style.display="none",note_08.style.display="none",note_09.style.display="none",note_10.style.display="none",note_11.style.display="none",note_12.style.display="none",note_13.style.display="none",note_14.style.display="none",note_15.style.display="none",note_16.style.display="none",note_17.style.display="none",note_18.style.display="none",note_19.style.display="none",note_20.style.display="none")}});
// end modify a note

// add a note | add-a-note LIMIT REACHED
var note_limit = document.getElementById("thats-all");
var yer_done = document.getElementById("note-limit");
var zipit = document.getElementsByClassName("shutit")[0];

window.addEventListener("load", function(){
	yer_done.onclick = function() {
	  note_limit.style.display = "block";
	}
	zipit.onclick = function() {
	  note_limit.style.display = "none";
	}
	window.onclick = function(event) {
	  if (event.target == note_limit) {
	    note_limit.style.display = "none";
	  }
	}
});
// end add a note LIMIT REACHED

// add a note - copy to clipboard
var but = document.getElementsByClassName('btn');
var txt = document.getElementsByClassName('input-copy');
for (var x = 0; x < but.length; x++) {
  (function(x) {
    but[x].addEventListener("click", function() {
      copyToClipboardMsg(txt[x], but[x]);
    }, false);
  })(x);
}

function copyToClipboardMsg(elem, msgElem) {
    var succeed = copyToClipboard(elem);
    var msg;
    if (!succeed) {
        msg = "<i class=\"fas fa-exclamation-triangle fa-fw\"></i>";
    } else {
        msg = "<i class=\"fas fa-check fa-fw\"></i>";
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    // msgElem.style.background = "#40d046";
    // msgElem.style.color = "#fff";
    // msgElem.style.border = "1px solid #fff";

    setTimeout(function() {
        msgElem.innerHTML = "<i class=\"far fa-copy fa-fw\"></i>";
        // msgElem.style.background = "#fff";
        // msgElem.style.color = "rgba(255,255,255,0.8)";
        // msgElem.style.border = "1px solid #757575";

    }, 750);
}


function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
        succeed = document.execCommand("copy");

    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }

    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;

}

// a static link - stop from jumping to top of page
$('a.static').click(function(e)
{
   e.preventDefault();
});

// reset all form onload
function clearForms() {
  var i;
  for (i = 0; (i < document.forms.length); i++) {
    document.forms[i].reset();
  }
}

// reset icon at the end of each search field
function reset_google() {
	var str = '';
    document.getElementById("gsearch").value= str;
    document.getElementById("gsearch").select();
}

function reset_url() {
	var str = '';
    document.getElementById("addressfield").value= str;
    document.getElementById("addressfield").select();
}

function reset_bing() {
	var str = '';
    document.getElementById("bsearch").value= str;
    document.getElementById("bsearch").select();
}

function reset_ref() {
	var str = '';
    document.getElementById("refsearch").value= str;
    document.getElementById("refsearch").select();
}

function reset_yt() {
	var str = '';
    document.getElementById("ytsearch").value= str;
    document.getElementById("ytsearch").select();
}

// decide where to send for dictionary or thesaurus search  
// when Thesaurus is primary search and Dictionary holds the radio button
// OnSubmitForm() - if Thesaurus is primary but Dictionary is checked
function OnSubmitForm() {
  if(document.reference.dictionary.checked == true) 
  {
    document.reference.action ="https://dictionary.com/browse/" + document.getElementById('refsearch').value;
    // used to be (below). not sure why the empty quotes at end...?
    // document.reference.action ="https://dictionary.com/browse/" + document.getElementById('q').value + "";
  } else {
    document.reference.action ="https://www.thesaurus.com/browse/" + document.getElementById('refsearch').value;
    // document.reference.action ="http://www.thesaurus.com/browse/" + document.getElementById('q').value + "";
  }
  return true;
}

// decide where to send for dictionary or thesaurus search  
// when Dictionary is primary search and Thesaurus holds the radio button
// OnSubmitFormSwap() - if Dictionary is primary but Thesaurus is checked
function OnSubmitFormSwap() {
  if(document.reference.thesaurus.checked == true) 
  {
    document.reference.action ="https://www.thesaurus.com/browse/" + document.getElementById('refsearch').value;
    // document.reference.action ="http://www.thesaurus.com/browse/" + document.getElementById('q').value + "";
  } else {
    document.reference.action ="https://dictionary.com/browse/" + document.getElementById('refsearch').value;
    // document.reference.action ="https://dictionary.com/browse/" + document.getElementById('q').value + "";
  }
  return true;
}

// begin bing search
function submitBing() {
  if(document.getElementById("bingImages").checked == true) 
  {
    document.bing.action ="https://www.bing.com/images/search";
  } else if (document.getElementById("bingMaps").checked == true) { 
    document.bing.action ="https://www.bing.com/maps/default.aspx";
  } else {
    document.bing.action ="https://www.bing.com/search";
  }
  return true;
}
// bing on/off images/maps
$(".bchk").change(function() {
    $(".bchk").not(this).prop('checked', false);
});
// end bing search

// begin google search
function submitGoogle() {
  if(document.getElementById("googleImages").checked == true) 
  {
    document.google.action ="https://images.google.com/images";
  } else if (document.getElementById("googleMaps").checked == true) { 
    document.google.action ="https://maps.google.com/maps";
  } else {
    document.google.action ="https://www.google.com/search";
  }
  return true;
}
// google on/off images/maps
$(".gchk").change(function() {
    $(".gchk").not(this).prop('checked', false);
});
// end google search

// make sure http:// is on the front of anything submitted by the URL field
// open in new tab and then make sure everything is reset back in 
// original tab. Opera requires the additional complications.
function submitURLFieldForm() {
    var url = document.getElementById('addressfield').value;
    if (!url.match(/^[a-zA-Z]+:\/\//)) {
        url = 'http://' + url;
    }
    window.open(url);
    document.getElementsByName('urlField')[0].reset();
    resetForm();
    return false;
}
// window.onload = function() {
//     resetForm();
// }
// function resetForm() {
//     var address = document.getElementsByName('address')[0];
//     address.focus();
//     address.value = "http://";
// }


/* sweet rememberme triangle inside circle all css */
$('input[name="remember_me"]').change(function(){
    if($(this).is(":checked")) {
        $('.aa-rm-out').addClass("checkablue");
        $('.aa-rm-in').addClass("checkaroo");
        $('.rm-rm').addClass("hot");
    } else {
        $('.aa-rm-out').removeClass("checkablue");
        $('.aa-rm-in').removeClass("checkaroo");
        $('.rm-rm').removeClass("hot");
    }
});

/* show passwords */
$("#showLoginPass").click(function(){
  var x = document.getElementById("password");
    $(this).toggleClass("showPassOn");

    if ($.trim($(this).html()) === '<i class="far fa-eye-slash"></i> Hide password') {
        $(this).html('<i class="far fa-eye"></i> Show password');
        x.type = "password";
    } else {
        $(this).html('<i class="far fa-eye-slash"></i> Hide password');
        x.type = "text";
    }
    return false;
  });

$("#showSignupPass").click(function(){
  var x = document.getElementById("showPassword");
  var y = document.getElementById("showConf");
    $(this).toggleClass("showPassOn");

    if ($.trim($(this).html()) === '<i class="far fa-eye-slash"></i> Hide passwords') {
        $(this).html('<i class="far fa-eye"></i> Show passwords');
        x.type = "password";
        y.type = "password";
    } else {
        $(this).html('<i class="far fa-eye-slash"></i> Hide passwords');
        x.type = "text";
        y.type = "text";
    }
    return false;
  });


/* 	edit_order.php -> only owner can move hyperlinks so
	there's no shared_with version of this 	*/
// sort hyperlinks - start
$(document).ready(function() {
  $( "#sortable" ).sortable({
	update: function (event, ui) {

		save_order();
		//console.log('hello there');
	 }	
  });
});

function save_order() {
var reorder = new Array();
  $('ul#sortable li').each(function() {
    reorder.push($(this).attr("id"));
    // console.log(reorder);
  });

	$.ajax({
		url: 'edit_order_ajax.php',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			reorder: reorder
		}, success: function (response) {
			console.log(response);
		}
	});

}
// sort hyperlinks - end

// add a note sort
//https://www.youtube.com/watch?v=V1nYMDoSCXY&ab_channel=CodingPassiveIncome
$(document).ready(function () {
	$('#sortanote').sortable({
		update: function (event, ui) {
			$(this).children().each(function (index) {
				if ($(this).attr('sort') != (index+1)) {
					$(this).attr('sort', (index+1)).addClass('updated');
				}
			});

			save_new_positions();
		}
	});
});
// ajax background save for sorting add a note
function save_new_positions() {
	var positions = [];
	$('.updated').each(function () {
		positions.push([$(this).attr('id'), $(this).attr('sort')]);
		$(this).removeClass('updated');
	});

	$.ajax({
		url: 'sort_note.php',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			positions: positions
		}, success: function (response) {
			console.log(response);
		}
	});

}


// edit_searches.php -> sortable search fields, opens:
// edit_search_order_owner.php and
// edit_search_order_shared_with.php
// invokes sortable and prevents instructions from moving
$("#sortablesearch").sortable({
    "cancel":"li.static",
    "update":function(event, ui) {
        $("#sortablesearch li.static").each(function() {
           var desiredLocation = $(this).attr("stay").replace("static-","");
           var currentLocation = $(this).index();
           while(currentLocation < desiredLocation) {
             $(this).next().insertBefore(this);
              currentLocation++;  
            }
            while(currentLocation > desiredLocation) {
             $(this).prev().insertAfter(this);
              currentLocation--;  
            }
        });
        if ($(this).hasClass('owner')) {
        	save_search_order();
        } else {
        	save_search_shared_with();
        }
    }
});
/*  only allow 1 row to be placed beneath instructions. */
$(document).ready(function() {
    $("#sortablesearch li.static").each(function () {
         $(this).attr("stay", "static-" + $(this).index());
    }); 
  
});
/* 	grab new order of search fields and put value into input with
	id = search_order */
function save_search_order() {
var reorder = [];
  $('ul#sortablesearch li.ct').each(function() {
    reorder.push($(this).attr("id"));

  });

	$.ajax({
		url: 'search_order_owner_ajax.php',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			reorder: reorder
		}, success: function (response) {
			console.log(response);
		}
	});

}

function save_search_shared_with() {
var reorder = [];
  $('ul#sortablesearch li.ct').each(function() {
    reorder.push($(this).attr("id"));

  });

	$.ajax({
		url: 'search_order_shared_with_ajax.php',
		method: 'POST',
		dataType: 'text',
		data: {
			update: 1,
			reorder: reorder
		}, success: function (response) {
			console.log(response);
		}
	});

}

// footer_contact_ajax
$(document).ready(function() {
 $('#send-footer').click(function() {
 	var name = $('#name').val();
 	var message = $('#message').val();

 	if (name == '') {
 		$('#error_message').html("What's your name?");
 	} else if (message == '') {
 		$('#error_message').html("Don't send me a blank message!");
 	} else {
 		$('#error_message').html('');
 		$.ajax({
 			url:"footer_contact_ajax.php",
 			method:"POST",
 			data:{name:name, message:message},
 			success:function(data) {
 				$("form").trigger("reset");
 				$('#success_message').fadeIn().html(data);

				setTimeout(function() {
				  $("#success_message").fadeOut('slow');
				}, 2000);

 			}
 		});
 	}
 });
});

$(document).ready(function() { // 122120856 start

// Dictionary or Thesaurus on edit_searches.php
	$('#d').click(function(){
	  $(this).addClass('selected');
	  $('#dict').addClass('selected');
	  $('#dic-row').addClass('selected');
	  if ($('#t').hasClass('selected')) {
	  	$('#t').removeClass('selected');
	  	$('#thes').removeClass('selected');
	  	$('#the-row').removeClass('selected');
	  }
	});
	$('#t').click(function(){
	  $(this).addClass('selected');
	  $('#thes').addClass('selected');
	  $('#the-row').addClass('selected');
	  if ($('#d').hasClass('selected')) {
	  	$('#d').removeClass('selected');
	  	$('#dict').removeClass('selected');
	  	$('#dic-row').removeClass('selected');
	  }
	});


// checkbox edit/share selections
	$('input:checkbox.edit').change(function(){
	    if($(this).is(":checked")) {
	        $('label.edit').addClass("checked");
	        $('.echeckon').addClass("showcheck");
	    } else {
	        $('label.edit').removeClass("checked");
	        $('.echeckon').removeClass("showcheck");
	    }
	});
	$('input:checkbox.share').change(function(){
	    if($(this).is(":checked")) {
	        $('label.share').addClass("checked");
	        $('.scheckon').addClass("showcheck");
	    } else {
	        $('label.share').removeClass("checked");
	        $('.scheckon').removeClass("showcheck");
	    }
	});

/* toggle pages */
$('.tab').hide();
$('.tab.active').show();

	$('.tabs .tab-links input').on('click', function(e)  {
    var currentAttrValue = $(this).attr('name');
    var addthis = "#";
    var thesetwo = addthis.concat(currentAttrValue);
    // ^^ had to add these two together in JS instead of on the html page
    // because the # was interfering with the Ajax form submission.
    // holy cow this took a long time to figure out!

	    // $('.tabs ' + currentAttrValue).slideDown(400).siblings().slideUp(400);
	    $('.tabs ' + thesetwo).show().siblings().hide();

	    $(this).closest('li').addClass('active').siblings().removeClass('active');

    // e.preventDefault();
	}); // end tab switch

	$('.project-details').hide();
  	// $('.review-project').click(function() {
  	$('.review-project').on('click', function(e) {
    var active = $(this);
    var toggle = $(this).next('.project-details');

    $('.project-details').not(toggle).slideUp();
    $('.review-project').not(active).removeClass('active');

    $(toggle).slideToggle();
    if ($(active).hasClass('active')) {
      $(active).removeClass('active');
    } else {
      $(active).addClass('active');
    }
  });

  	// allow formatting in project notes
	document.getElementById('textbox').addEventListener('keydown', function(e) {
	  if (e.key == 'Tab') {
	    e.preventDefault();
	    var start = this.selectionStart;
	    var end = this.selectionEnd;

	               // set textarea value to: text before caret + tab + text after caret
	    this.value = this.value.substring(0, start) +
	      "\t" + this.value.substring(end);

	               // put caret at right position again
	    this.selectionStart =
	      this.selectionEnd = start + 1;
	  }
	});
}); // // 122120856 end

$(document).ready(function() {
  $("#email-bob").hide();
  $("#toggle-contact-form").click(function(){
      $(this).toggleClass("active").next().slideToggle(600);

      if ($.trim($(this).text()) === 'close') {
          $(this).html('<i class="fa fa-star" aria-hidden="true"></i><span class="tiny-mobile">&nbsp;&nbsp;</span> comments | questions | suggestions <span class="tiny-mobile">&nbsp;&nbsp;</span><i class="fa fa-star" aria-hidden="true"></i>');
      } else {
          $(this).html('<i class="fa fa-times-circle close-left" aria-hidden="true"></i> close <i class="fa fa-times-circle close-right" aria-hidden="true"></i>');
      }
    return false;
  });
});

// solution to submit without refresh found at: https://www.youtube.com/watch?t=470&v=GrycH6F-ksY&feature=youtu.be&ab_channel=Codecourse
$('form.ajax').on('submit', function() {
	var that = $(this),
	url = that.attr('action'),
	type = that.attr('method'),
	data = {};

	that.find('[name]').each(function(index, value) {
		// console.log(value);
		var that = $(this),
			name = that.attr('name'),
			value = that.val();
		data[name] = value;
	});
	$.ajax({
		url: url,
		type: type,
		data: data,
		success: function(response) {
			// console.log(response);
		}
	});
	// console.log(data);
	return false;
});


/*
// was working on this 01.11.21 0905 - abandoned
// for future consideration.
// https://www.youtube.com/watch?v=a1aGlaA4kQQ&ab_channel=Webslesson
$(document).ready(function() {
	$('form.ajax-note').on('submit', function() {
		var that = $(this),
		url = that.attr('action'),
		type = that.attr('method'),
		data = {};

		that.find('[name]').each(function(index, value) {
			// console.log(value);
			var that = $(this),
				name = that.attr('name'),
				value = that.val();
			data[name] = value;
		});
		$.ajax({
			url: url,
			type: type,
			data: data,
			success: function(response) {
				// console.log(response);
				$($row).val();
			}
		});
		// console.log(data);
		return false;
	});
	setInterval(function() {
		$('#foo').load("_logged_in/add_a_note.php").fadeIn("fast");

	}, 1000);
});
*/