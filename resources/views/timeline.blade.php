<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style id="applicationStylesheet" type="text/css">
        .mediaViewInfo {
            --web-view-name: Premiere page;
            --web-view-id: Premiere_page;
            --web-scale-on-resize: true;
            --web-enable-deep-linking: true;
        }
        :root {
            --web-view-ids: Premiere_page;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            border: none;
        }
        #Premiere_page {
            position: absolute;
            width: 1920px;
            height: 1080px;
            background-color: rgba(255,255,255,1);
            overflow: hidden;
            --web-view-name: Premiere page;
            --web-view-id: Premiere_page;
            --web-scale-on-resize: true;
            --web-enable-deep-linking: true;
        }
        @keyframes fadein {

            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }

        }
        #Pfad_1 {
            fill: rgba(181,21,21,1);
        }
        .Pfad_1 {
            overflow: visible;
            position: absolute;
            width: 1920px;
            height: 1080px;
            left: 0px;
            top: 0px;
            transform: matrix(1,0,0,1,0,0);
        }
        #Komponente_25__3 {
            position: absolute;
            width: 1274.5px;
            height: 109px;
            left: 54.5px;
            top: 49.093px;
            overflow: visible;
            --web-animation: fadein 0.3s ease-out;
            --web-action-type: page;
            cursor: pointer;
        }
        #LAM_EN_CHIFFRES {
            left: 184px;
            top: 3px;
            position: absolute;
            overflow: visible;
            width: 667px;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto Condensed;
            font-style: normal;
            font-weight: bold;
            font-size: 90px;
            color: rgba(255,255,255,1);
            text-transform: uppercase;
        }
        #Gruppe_26 {
            transform: translate(0px, 0px) matrix(1,0,0,1,42.5,-21.5) rotate(90deg);
            transform-origin: center;
            position: absolute;
            width: 66px;
            height: 151px;
            left: 0px;
            top: 0px;
            overflow: visible;
        }
        #Rechteck_2 {
            fill: rgba(255,255,255,1);
        }
        .Rechteck_2 {
            position: absolute;
            overflow: visible;
            width: 151px;
            height: 66px;
            left: 0px;
            top: 0px;
        }
        #Image3_modif {
            position: absolute;
            width: 93px;
            height: 53px;
            left: 1181.5px;
            top: 13.907px;
            overflow: visible;
        }
        #Komponente_26__1 {
            position: absolute;
            width: 1769.5px;
            height: 109px;
            left: 54.5px;
            top: 168.093px;
            overflow: visible;
        }
        #Image1_modif {
            position: absolute;
            width: 154px;
            height: 87px;
            left: 1615.5px;
            top: 3.907px;
            overflow: visible;
        }
        #Nom {
            left: 186px;
            top: 3px;
            position: absolute;
            overflow: visible;
            width: 179px;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto Condensed;
            font-style: normal;
            font-weight: bold;
            font-size: 90px;
            color: rgba(255,255,255,1);
            text-transform: uppercase;
        }
        #Gruppe_27 {
            transform: translate(0px, 0px) matrix(1,0,0,1,42.5,-21.5) rotate(90deg);
            transform-origin: center;
            position: absolute;
            width: 66px;
            height: 151px;
            left: 0px;
            top: 0px;
            overflow: visible;
        }
        #Rechteck_3 {
            fill: rgba(255,255,255,1);
        }
        .Rechteck_3 {
            position: absolute;
            overflow: visible;
            width: 151px;
            height: 66px;
            left: 0px;
            top: 0px;
        }
        #Komponente_27__1 {
            position: absolute;
            width: 1227.5px;
            height: 150px;
            left: 54.5px;
            top: 282px;
            overflow: visible;
        }
        #Image4_modif {
            position: absolute;
            width: 266px;
            height: 150px;
            left: 961.5px;
            top: 0px;
            overflow: visible;
        }
        #Directeurs {
            left: 186px;
            top: 15.471px;
            position: absolute;
            overflow: visible;
            width: 463px;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto Condensed;
            font-style: normal;
            font-weight: bold;
            font-size: 90px;
            color: rgba(255,255,255,1);
            text-transform: uppercase;
        }
        #Gruppe_28 {
            transform: translate(0px, 0px) matrix(1,0,0,1,42.5,-9.0293) rotate(90deg);
            transform-origin: center;
            position: absolute;
            width: 66px;
            height: 151px;
            left: 0px;
            top: 0px;
            overflow: visible;
        }
        #Rechteck_4 {
            fill: rgba(255,255,255,1);
        }
        .Rechteck_4 {
            position: absolute;
            overflow: visible;
            width: 151px;
            height: 66px;
            left: 0px;
            top: 0px;
        }
        #Komponente_28__1 {
            position: absolute;
            width: 1745.5px;
            height: 130.306px;
            left: 54.5px;
            top: 418.694px;
            overflow: visible;
        }
        #Image2_modif {
            position: absolute;
            width: 209px;
            height: 118px;
            left: 1536.5px;
            top: 12.306px;
            overflow: visible;
        }
        #Site {
            left: 184px;
            top: 3px;
            position: absolute;
            overflow: visible;
            width: 166px;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto Condensed;
            font-style: normal;
            font-weight: bold;
            font-size: 90px;
            color: rgba(255,255,255,1);
            text-transform: uppercase;
        }
        #Gruppe_29 {
            transform: translate(0px, 0px) matrix(1,0,0,1,42.5,-21.5) rotate(90deg);
            transform-origin: center;
            position: absolute;
            width: 66px;
            height: 151px;
            left: 0px;
            top: 0px;
            overflow: visible;
        }
        #Rechteck_5 {
            fill: rgba(255,255,255,1);
        }
        .Rechteck_5 {
            position: absolute;
            overflow: visible;
            width: 151px;
            height: 66px;
            left: 0px;
            top: 0px;
        }
        #Komponente_29__1 {
            position: absolute;
            width: 1450.5px;
            height: 112.083px;
            left: 54.5px;
            top: 542.917px;
            overflow: visible;
        }
        #Image6_modif {
            position: absolute;
            width: 159px;
            height: 90px;
            left: 1291.5px;
            top: 22.083px;
            overflow: visible;
        }
        #Histoire_chappelle {
            left: 186px;
            top: 3px;
            position: absolute;
            overflow: visible;
            width: 808px;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto Condensed;
            font-style: normal;
            font-weight: bold;
            font-size: 90px;
            color: rgba(255,255,255,1);
            text-transform: uppercase;
        }
        #Gruppe_30 {
            transform: translate(0px, 0px) matrix(1,0,0,1,42.5,-21.5) rotate(90deg);
            transform-origin: center;
            position: absolute;
            width: 66px;
            height: 151px;
            left: 0px;
            top: 0px;
            overflow: visible;
        }
        #Rechteck_6 {
            fill: rgba(255,255,255,1);
        }
        .Rechteck_6 {
            position: absolute;
            overflow: visible;
            width: 151px;
            height: 66px;
            left: 0px;
            top: 0px;
        }
        #Komponente_30__1 {
            position: absolute;
            width: 1801.5px;
            height: 187.86px;
            left: 54.5px;
            top: 667.14px;
            overflow: visible;
        }
        #Image8_modif {
            position: absolute;
            width: 249px;
            height: 140px;
            left: 1552.5px;
            top: 47.86px;
            overflow: visible;
        }
        #n_25ans_formations {
            left: 186px;
            top: 3px;
            position: absolute;
            overflow: visible;
            width: 811px;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto Condensed;
            font-style: normal;
            font-weight: bold;
            font-size: 90px;
            color: rgba(255,255,255,1);
            text-transform: uppercase;
        }
        #Gruppe_31 {
            transform: translate(0px, 0px) matrix(1,0,0,1,42.5,-21.5) rotate(90deg);
            transform-origin: center;
            position: absolute;
            width: 66px;
            height: 151px;
            left: 0px;
            top: 0px;
            overflow: visible;
        }
        #Rechteck_7 {
            fill: rgba(255,255,255,1);
        }
        .Rechteck_7 {
            position: absolute;
            overflow: visible;
            width: 151px;
            height: 66px;
            left: 0px;
            top: 0px;
        }
        #Komponente_31__1 {
            position: absolute;
            width: 1392.5px;
            height: 158.175px;
            left: 54.5px;
            top: 793.825px;
            overflow: visible;
        }
        #Image7_modif {
            position: absolute;
            width: 253px;
            height: 142px;
            left: 1139.5px;
            top: 16.175px;
            overflow: visible;
        }
        #Expositions {
            left: 186px;
            top: 3px;
            position: absolute;
            overflow: visible;
            width: 504px;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto Condensed;
            font-style: normal;
            font-weight: bold;
            font-size: 90px;
            color: rgba(255,255,255,1);
            text-transform: uppercase;
        }
        #Gruppe_32 {
            transform: translate(0px, 0px) matrix(1,0,0,1,42.5,-21.5) rotate(90deg);
            transform-origin: center;
            position: absolute;
            width: 66px;
            height: 151px;
            left: 0px;
            top: 0px;
            overflow: visible;
        }
        #Rechteck_8 {
            fill: rgba(255,255,255,1);
        }
        .Rechteck_8 {
            position: absolute;
            overflow: visible;
            width: 151px;
            height: 66px;
            left: 0px;
            top: 0px;
        }
        #Komponente_32__1 {
            position: absolute;
            width: 1677.5px;
            height: 109px;
            left: 54.5px;
            top: 915.586px;
            overflow: visible;
        }
        #Image5_modif {
            position: absolute;
            width: 139px;
            height: 79px;
            left: 1538.5px;
            top: 27.414px;
            overflow: visible;
        }
        #Futur {
            left: 186px;
            top: 3px;
            position: absolute;
            overflow: visible;
            width: 245px;
            white-space: nowrap;
            text-align: left;
            font-family: Roboto Condensed;
            font-style: normal;
            font-weight: bold;
            font-size: 90px;
            color: rgba(255,255,255,1);
            text-transform: uppercase;
        }
        #Gruppe_33 {
            transform: translate(0px, 0px) matrix(1,0,0,1,42.5,-21.5) rotate(90deg);
            transform-origin: center;
            position: absolute;
            width: 66px;
            height: 151px;
            left: 0px;
            top: 0px;
            overflow: visible;
        }
        #Rechteck_9 {
            fill: rgba(255,255,255,1);
        }
        .Rechteck_9 {
            position: absolute;
            overflow: visible;
            width: 151px;
            height: 66px;
            left: 0px;
            top: 0px;
        }
    </style>
</head>
<body>
<div id="Premiere_page">
    <svg class="Pfad_1" viewBox="0 0 1920 1080">
        <path id="Pfad_1" d="M 0 0 L 1920 0 L 1920 1080 L 0 1080 L 0 0 Z">
        </path>
    </svg>
    <div onclick="window.location='{{ url("Timeline/Lam en chiffres") }}'" id="Komponente_25__3" class="Komponente_25___3">
        <div id="LAM_EN_CHIFFRES">
            <span>LAM EN CHIFFRES</span>
        </div>
        <div id="Gruppe_26">
            <svg class="Rechteck_2">
                <rect id="Rechteck_2" rx="0" ry="0" x="0" y="0" width="66" height="151">
                </rect>
            </svg>
        </div>
        <img id="Image3_modif" src="Image3_modif.png" srcset="Image3_modif.png 1x, Image3_modif@2x.png 2x">

    </div>
    <div id="Komponente_26__1" class="Komponente_26___1">
        <img id="Image1_modif" src="Image1_modif.png" srcset="Image1_modif.png 1x, Image1_modif@2x.png 2x">

        <div id="Nom">
            <span>Nom</span>
        </div>
        <div id="Gruppe_27">
            <svg class="Rechteck_3">
                <rect id="Rechteck_3" rx="0" ry="0" x="0" y="0" width="66" height="151">
                </rect>
            </svg>
        </div>
    </div>
    <div id="Komponente_27__1" class="Komponente_27___1">
        <img id="Image4_modif" src="Image4_modif.png" srcset="Image4_modif.png 1x, Image4_modif@2x.png 2x">

        <div id="Directeurs">
            <span>Directeurs</span>
        </div>
        <div id="Gruppe_28">
            <svg class="Rechteck_4">
                <rect id="Rechteck_4" rx="0" ry="0" x="0" y="0" width="66" height="151">
                </rect>
            </svg>
        </div>
    </div>
    <div id="Komponente_28__1" class="Komponente_28___1">
        <img id="Image2_modif" src="Image2_modif.png" srcset="Image2_modif.png 1x, Image2_modif@2x.png 2x">

        <div id="Site">
            <span>Site</span>
        </div>
        <div id="Gruppe_29">
            <svg class="Rechteck_5">
                <rect id="Rechteck_5" rx="0" ry="0" x="0" y="0" width="66" height="151">
                </rect>
            </svg>
        </div>
    </div>
    <div id="Komponente_29__1" class="Komponente_29___1">
        <img id="Image6_modif" src="Image6_modif.png" srcset="Image6_modif.png 1x, Image6_modif@2x.png 2x">

        <div id="Histoire_chappelle">
            <span>Histoire chappelle</span>
        </div>
        <div id="Gruppe_30">
            <svg class="Rechteck_6">
                <rect id="Rechteck_6" rx="0" ry="0" x="0" y="0" width="66" height="151">
                </rect>
            </svg>
        </div>
    </div>
    <div id="Komponente_30__1" class="Komponente_30___1">
        <img id="Image8_modif" src="Image8_modif.png" srcset="Image8_modif.png 1x, Image8_modif@2x.png 2x">

        <div id="n_25ans_formations">
            <span>125ans formations</span>
        </div>
        <div id="Gruppe_31">
            <svg class="Rechteck_7">
                <rect id="Rechteck_7" rx="0" ry="0" x="0" y="0" width="66" height="151">
                </rect>
            </svg>
        </div>
    </div>
    <div id="Komponente_31__1" class="Komponente_31___1">
        <img id="Image7_modif" src="Image7_modif.png" srcset="Image7_modif.png 1x, Image7_modif@2x.png 2x">

        <div id="Expositions">
            <span>Expositions</span>
        </div>
        <div id="Gruppe_32">
            <svg class="Rechteck_8">
                <rect id="Rechteck_8" rx="0" ry="0" x="0" y="0" width="66" height="151">
                </rect>
            </svg>
        </div>
    </div>
    <div id="Komponente_32__1" class="Komponente_32___1">
        <img id="Image5_modif" src="Image5_modif.png" srcset="Image5_modif.png 1x, Image5_modif@2x.png 2x">

        <div id="Futur">
            <span>Futur</span>
        </div>
        <div id="Gruppe_33">
            <svg class="Rechteck_9">
                <rect id="Rechteck_9" rx="0" ry="0" x="0" y="0" width="66" height="151">
                </rect>
            </svg>
        </div>
    </div>
</div>
</body>
</html>
