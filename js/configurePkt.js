const serverType = document.getElementById('serverType');

serverType.onchange = function(){
    hideBoxes(serverType.value);

};


function hideBoxes(servType) {

  //All boxes are hidden at start, lets re-show the ones we need.


  document.getElementById("ttnIDF").hidden=true;
  document.getElementById("ttnKeyF").hidden=true;
  document.getElementById("ttnServF").hidden=true;
  document.getElementById("loriotServF").hidden=true;
  document.getElementById("freqF").hidden=true;
  document.getElementById("servF").hidden=true;
  document.getElementById("freqF").hidden=true;


  if(serverType.value == "TTN") {
    document.getElementById("ttnIDF").hidden=false;
    document.getElementById("ttnKeyF").hidden=false;
    document.getElementById("ttnServF").hidden=false;
    document.getElementById("freqF").hidden=false;
  }


  if(serverType.value == "LORIOT") {
    document.getElementById("loriotServF").hidden=false;
    document.getElementById("freqF").hidden=false;
  }

  if(serverType.value == "TTI") {
      document.getElementById("servF").hidden=false;
      document.getElementById("freqF").hidden=false;
  }
  if(serverType.value == "OTHER") {
      document.getElementById("servF").hidden=false;
      document.getElementById("freqF").hidden=false;
  }


}

hideBoxes(serverType.value);
