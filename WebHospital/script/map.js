var s = Snap("#plan");

var backBlocRoom;
var backScanerRoom;
var backExamRoom;
var backHallRoom;
var madiv;


drawHallRoom();
drawBlocRoom();
drawExamRoom();
drawScanerRoom();


backBlocRoom.hover(handler_hoverInBloc, handler_hoverOut, null, null);
backScanerRoom.hover(handler_hoverInScaner, handler_hoverOut, null, null);
backExamRoom.hover(handler_hoverInExam, handler_hoverOut, null, null);
backHallRoom.hover(handler_hoverInHall, handler_hoverOut, null, null);

function handler_hoverInBloc(){
    document.getElementById("nomPiece").innerHTML = "Actuellement dans le bloc opératoire";
    backBlocRoom.attr({
        fill: "#27AE60",
        fillOpacity: 2,
    });

    var patientsBloc = document.getElementsByClassName("bloc");

    if(patientsBloc.length == 0){
        document.getElementById("informations").innerHTML = "<h5>La pièce est acutellement vide</h5>";
    }else{
        madiv = "<ul class=\"list-group\">";
        for(i=0; i < patientsBloc.length; i++){
        
        madiv += "<li class=\"list-group-item\">Nom : " + document.getElementsByClassName("bloc")[i].getAttribute("nom") + "  Prenom : "+ document.getElementsByClassName("bloc")[i].getAttribute("prenom")+ "</li>";
        }

        madiv += "</ul>"
        document.getElementById("informations").innerHTML = madiv;
    }


}



function handler_hoverInExam(){
    document.getElementById("nomPiece").innerHTML = "Actuellement en salle d'examen";
    var patientsExam = document.getElementsByClassName("exam");
    //console.log(patients.length);
    if(patientsExam.length == 0){
        document.getElementById("informations").innerHTML = "<h5>La pièce est acutellement vide</h5>";
    }else{
        madiv = "<ul class=\"list-group\">";
        for(i=0; i < patientsExam.length; i++){
        
        madiv += "<li class=\"list-group-item\">Nom : " + document.getElementsByClassName("exam")[i].getAttribute("nom") + "  Prenom : "+ document.getElementsByClassName("exam")[i].getAttribute("prenom")+ "</li>";
        }

        madiv += "</ul>"
        document.getElementById("informations").innerHTML = madiv;
    }
    

    backExamRoom.attr({
        fill: "#CB4335",
        fillOpacity: 2,
    });
}

function handler_hoverInScaner(){
    document.getElementById("nomPiece").innerHTML = "Actuellement en imagerie";

    var patientsScan = document.getElementsByClassName("scan");
    
    if(patientsScan.length == 0){
        document.getElementById("informations").innerHTML = "<h5>La pièce est acutellement vide</h5>";
    }else{
        madiv = "<ul class=\"list-group\">";
        for(i=0; i < patientsScan.length; i++){
        
        madiv += "<li class=\"list-group-item\">Nom : " + document.getElementsByClassName("scan")[i].getAttribute("nom") + "  Prenom : "+ document.getElementsByClassName("scan")[i].getAttribute("prenom")+ "</li>";
        }

        madiv += "</ul>"
        document.getElementById("informations").innerHTML = madiv;
    }

    backScanerRoom.attr({
        fill: "#F39C12",
        fillOpacity: 5,
    });
}

function handler_hoverInHall(){
    document.getElementById("nomPiece").innerHTML = "Actuellement dans le hall";

    var patientsHall = document.getElementsByClassName("hall");
    
    if(patientsHall.length == 0){
        document.getElementById("informations").innerHTML = "<h5>La pièce est acutellement vide</h5>";
    }else{
        madiv = "<ul class=\"list-group\">";
        for(i=0; i < patientsHall.length; i++){
        
        madiv += "<li class=\"list-group-item\">Nom : " + document.getElementsByClassName("hall")[i].getAttribute("nom") + "  Prenom : "+ document.getElementsByClassName("hall")[i].getAttribute("prenom")+ "</li>";
        }

        madiv += "</ul>"
        document.getElementById("informations").innerHTML = madiv;
    }

    backHallRoom.attr({
        fill: "#3498DB",
        fillOpacity: 2,
    });
}

function handler_hoverOut(){
    document.getElementById("nomPiece").innerHTML = "Passer votre curseur sur les pièces";
    document.getElementById("informations").innerHTML = "";

    backHallRoom.attr({
        fill: "#3498DB",
        fillOpacity: .5,
    });

    backBlocRoom.attr({
        fill: "#27AE60",
        fillOpacity: .5,
    });

    backExamRoom.attr({
        fill: "#CB4335",
        fillOpacity: .5,
    });

    backScanerRoom.attr({
        fill: "#F39C12",
        fillOpacity: .5,
    });
}

function drawHallRoom(){

    backHallRoom = s.rect(150,0,100,500);
    backHallRoom.attr({
        fill: "#3498DB",
        fillOpacity: .5,
    });
    var titleHallRoom = s.text(185,255, "Hall");

    s.line(150,0,250,0).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 5
    });

    s.line(150,500,250,500).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 5
    });

    s.line(250,0,250,75).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 3
    });

    s.line(250,150,250,350).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 3
    });

    s.line(250,500,250,425).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 3
    });
}

function drawBlocRoom(){

    backBlocRoom = s.rect(0,0, 150,500);
    backBlocRoom.attr({
        fill: "#27AE60",
        fillOpacity: .5,
    });

    var titleBlocRoom = s.text(25,255, "Bloc opératoire");

    s.line(0,0,150,0).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 5
    });

    s.line(0,0,0,500).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 5
    });

    s.line(0,500,150,500).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 5
    });

    s.line(150,0,150,75).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 3
    });

    s.line(150,500,150,150).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 3
    });
}

function drawExamRoom(){

    backExamRoom = s.rect(250,0, 150,250);
    backExamRoom.attr({
        fill: "#CB4335",
        fillOpacity: .5,
    });

    var titleExamRoom = s.text(275,130, "Salle d'examen");

    s.line(250,0,400,0).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 5
    });

    s.line(250,250,400,250).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 3
    });

    s.line(400,0,400,250).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 3
    });
}

function drawScanerRoom(){

    backScanerRoom = s.rect(250,250, 150,250);
    backScanerRoom.attr({
        fill: "#F39C12",
        fillOpacity: .5,
    });

    var titleScanerRoom = s.text(290,375, "Imagerie");

    s.line(400,250,400,500).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 3
    });

    s.line(250,500,400,500).attr({
        fill: "#bada55",
        stroke: "#000",
        strokeWidth: 5
    });
}