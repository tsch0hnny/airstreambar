<?php
// Include the external script which contains the getBarStatus function
include 'functions/barStatus.php';

// Call the function and store the result
$barOpeningHourScript = getBarStatus();
?>
<?php
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $filenameWithoutExtension = basename(__FILE__, '.php');

    // Include the specific content file
    include "content/{$filenameWithoutExtension}-content.php";
    exit; // This will prevent any further output after the content has been included
} else {
?>
    <!DOCTYPE html>
    <html lang="de">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Airstream Bar</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        <link href="/output.css" rel="stylesheet">
    </head>

    <body class="bg-black">
        <div class="app flex flex-col max-h-screen">
            <div class="nav grid grid-cols-[1fr,auto,1fr] items-center py-2 fixed w-full bg-black shadow-cstm-lighter h-20 select-none">
                <svg id="logo" class="group h-12 mt-1 w-auto col-start-2" width="1811" height="694" viewBox="0 0 1811 694" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect class="group-hover:fill-amber-200 group-hover:blur-lg" y="309" width="37" height="60" rx="7" fill="white" />
                    <!-- hover glow effect WIP
                <path class="group-hover:fill-red-400 group-hover:blur-lg" d="M24.6769 121.024C25.1258 117.532 28.0988 114.917 31.6197 114.917L50.6493 114.917C54.6817 114.917 57.8802 118.315 57.6366 122.34L56.1668 146.619C55.922 150.663 52.3057 153.655 48.2872 153.139L27.9428 150.524C24.1084 150.031 21.3995 146.523 21.8924 142.688L24.6769 121.024Z" fill="white"/>
                <path class="group-hover:fill-red-400 group-hover:blur-lg" d="M1679.58 122.799C1679.05 118.617 1682.31 114.919 1686.53 114.919L1707.64 114.919C1711.16 114.919 1714.14 117.535 1714.59 121.027L1717.37 142.691C1717.86 146.525 1715.15 150.033 1711.32 150.526L1690.5 153.2C1686.66 153.693 1683.15 150.977 1682.67 147.136L1679.58 122.799Z" fill="white"/>
                <path class="flicker group-hover:fill-sky-500 group-hover:blur-lg" d="M1020.96 544C1014.72 554.956 1011 566.878 1011 578.882C1011 603.253 1024.48 621.878 1050.84 630.992C1054.81 632.379 1064.13 635.153 1068.09 635.153C1069.48 635.153 1070.47 634.361 1070.47 633.172C1070.47 630.794 1067.89 629.209 1065.71 628.615C1063.85 628.02 1062 627.51 1060.14 626.999C1057.04 626.147 1053.94 625.296 1050.84 624.058C1030.82 616.528 1021.9 603.649 1021.9 584.628C1021.9 574.92 1024.28 565.013 1028.84 556.097C1030.94 551.884 1033.41 547.853 1036.21 544H1020.96Z" fill="white"/>
                <path class="flicker group-hover:fill-sky-500 group-hover:blur-lg" fill-rule="evenodd" clip-rule="evenodd" d="M1231.32 544H1243.53C1243.13 545.093 1242.73 546.186 1242.34 547.279C1240.5 552.332 1238.67 557.384 1236.79 562.437C1241.94 568.975 1243.72 577.297 1243.72 586.808C1243.72 600.876 1239.17 614.943 1234.01 627.822C1231.63 633.964 1222.12 654.967 1214.98 654.967C1205.07 654.967 1201.5 646.447 1201.5 638.125C1201.5 627.426 1208.04 607.81 1211.81 597.507C1216.37 584.628 1225.69 559.069 1225.69 559.069L1227.47 554.511C1227.47 554.511 1229.45 549.15 1231.32 544ZM1236.39 580.864C1236.39 576.901 1235.8 572.938 1234.41 569.174C1234.01 570.263 1233.61 571.403 1233.22 572.542C1232.82 573.681 1232.43 574.82 1232.03 575.91C1231.26 577.965 1230.36 580.319 1229.38 582.897L1229.38 582.898C1222.49 600.961 1211.41 630.025 1211.41 644.069V645.456C1215.38 641.89 1218.55 636.342 1221.13 631.785C1229.45 616.727 1236.39 598.102 1236.39 580.864Z" fill="white"/>
                <path class="flicker group-hover:fill-sky-500 group-hover:blur-lg" d="M1324.2 544H1340.61C1328.92 561.788 1307.01 575.634 1285.95 583.241C1302.6 588.789 1312.31 601.668 1312.31 620.293C1312.31 652.787 1248.48 694 1197.93 694C1179.1 694 1160.86 686.075 1160.86 667.648C1160.86 657.939 1166.41 651.004 1169.98 651.004C1172.16 651.004 1173.55 652.589 1173.55 654.373C1173.55 655.046 1173.19 655.568 1172.69 656.29C1171.58 657.903 1169.78 660.514 1169.78 668.044C1169.78 681.517 1177.91 684.688 1191.99 684.688C1228.66 684.688 1300.42 651.797 1300.42 615.736C1300.42 598.3 1291.1 589.978 1271.08 589.978C1268.78 589.978 1266.57 590.231 1264.39 590.482C1262.26 590.726 1260.15 590.969 1258 590.969C1254.23 590.969 1249.67 587.6 1249.67 584.232C1249.67 582.647 1250.46 581.656 1252.25 581.26C1253.44 580.934 1254.7 580.668 1255.98 580.396C1257.04 580.172 1258.11 579.944 1259.19 579.675C1280.56 574.899 1308.24 562.571 1324.2 544Z" fill="white"/>
                <path class="flicker group-hover:fill-sky-500 group-hover:blur-lg" d="M1374.01 578.684C1386.7 578.684 1396.81 586.015 1396.81 592.752C1396.81 594.337 1395.81 595.328 1394.03 595.328C1391.48 595.328 1390.54 594.036 1389.43 592.522C1387.86 590.382 1385.97 587.798 1378.77 587.798C1363.9 587.798 1348.63 608.999 1348.63 626.633C1353.99 626.633 1373.22 604.244 1379.76 595.922C1380.35 595.13 1381.14 594.931 1382.14 594.931C1385.31 594.931 1390.26 599.092 1389.07 602.659C1388.97 602.963 1388.86 603.266 1388.75 603.568L1388.73 603.644C1386.47 610.018 1384.32 616.094 1384.32 623.067C1384.32 624.058 1384.71 624.454 1385.51 624.454C1396.34 624.644 1418.28 604.445 1430.03 592.474C1432.01 587.01 1433.58 582.295 1433.58 580.666C1433.58 579.08 1434.97 578.486 1436.76 578.486C1439.73 578.486 1443.89 581.854 1443.89 585.223C1443.89 588.007 1441.11 595.382 1439.23 600.368L1439.23 600.37C1438.7 601.769 1438.25 602.979 1437.94 603.848C1439.93 600.083 1458.76 577.693 1462.53 577.693C1465.9 577.693 1469.86 581.458 1469.86 584.628C1469.86 585.45 1469.05 587.148 1468 589.37C1466.01 593.576 1463.12 599.66 1463.12 605.235C1463.12 607.612 1463.91 608.603 1465.3 608.603C1473.59 608.603 1483.76 599.357 1489.69 593.964C1492.14 591.743 1493.86 590.176 1494.44 590.176C1496.62 590.176 1499 592.356 1499 594.337C1499 594.931 1498.8 595.13 1498.41 595.526C1492.26 603.055 1478.98 616.33 1468.67 616.33C1458.76 616.33 1454 608.405 1454 599.29C1454 598.498 1454 597.705 1454.2 596.913C1444.49 608.801 1435.76 622.274 1428.03 634.559C1427.04 635.946 1426.45 636.54 1424.86 636.54C1421.89 636.54 1417.72 633.172 1417.72 629.804C1417.72 627.072 1421.11 617.042 1423.14 611.234C1412.3 622.201 1398.42 633.37 1388.48 633.37C1380.35 633.37 1375.79 627.624 1374.6 619.897C1374.47 620.052 1374.33 620.211 1374.19 620.372C1374.01 620.579 1373.83 620.791 1373.64 621.007L1373.61 621.042C1368.21 627.278 1360.02 636.738 1352 636.738C1343.08 636.738 1338.33 628.615 1338.33 620.491C1338.33 603.253 1355.37 578.684 1374.01 578.684Z" fill="white"/>
                end hover glow effect WIP-->
                    <circle cx="583.5" cy="543.5" r="56.5" fill="white" />
                    <circle cx="801.5" cy="543.5" r="56.5" fill="white" />
                    <rect x="1638" y="480" width="173" height="35" rx="7" fill="white" />
                    <rect class="" y="309" width="37" height="60" rx="7" fill="white" />
                    <path class="" d="M24.6769 121.024C25.1258 117.532 28.0988 114.917 31.6197 114.917L50.6493 114.917C54.6817 114.917 57.8802 118.315 57.6366 122.34L56.1668 146.619C55.922 150.663 52.3057 153.655 48.2872 153.139L27.9428 150.524C24.1084 150.031 21.3995 146.523 21.8924 142.688L24.6769 121.024Z" fill="white" />
                    <path class="" d="M1679.58 122.799C1679.05 118.617 1682.31 114.919 1686.53 114.919L1707.64 114.919C1711.16 114.919 1714.14 117.535 1714.59 121.027L1717.37 142.691C1717.86 146.525 1715.15 150.033 1711.32 150.526L1690.5 153.2C1686.66 153.693 1683.15 150.977 1682.67 147.136L1679.58 122.799Z" fill="white" />
                    <path d="M31.6115 153.77C33.5326 140.621 36.643 127.653 41.8734 115.437C49.6132 97.3607 62.7618 70.3362 78 54.3201C118.173 12.0969 163.362 0 217 0H1519C1572.64 0 1617.83 12.0969 1658 54.3201C1673.24 70.3362 1686.39 97.3607 1694.13 115.437C1699.36 127.653 1702.47 140.621 1704.39 153.77L1723.42 284H1603.87V122.812C1603.87 120.051 1601.63 117.812 1598.87 117.812H1513.13C1510.63 117.812 1508.52 119.658 1508.18 122.134L1482.93 306.426L1457.51 122.129C1457.17 119.655 1455.06 117.812 1452.56 117.812H1367.7C1364.94 117.812 1362.7 120.051 1362.7 122.812V284H1328.33L1312.99 122.34C1312.74 119.773 1310.59 117.812 1308.01 117.812H1212.16C1209.58 117.812 1207.43 119.768 1207.18 122.332L1191.56 284H1157.3V242.871C1157.3 240.11 1155.06 237.871 1152.3 237.871H1103.94C1101.18 237.871 1098.94 235.633 1098.94 232.871V182.578C1098.94 179.817 1101.18 177.578 1103.94 177.578H1154.76C1157.52 177.578 1159.76 175.34 1159.76 172.578V122.812C1159.76 120.051 1157.52 117.812 1154.76 117.812H1041.01C1038.25 117.812 1036.01 120.051 1036.01 122.812V284H1005.29C1004.78 282.752 1004.22 281.555 1003.63 280.41C999.758 272.676 992.961 267.812 983.234 265.82C995.07 261.953 1003.1 254.98 1007.32 244.902C1011.65 234.824 1013.82 221.348 1013.82 204.473C1013.82 187.012 1012.41 171.836 1009.6 158.945C1006.91 145.938 1001.52 135.859 993.43 128.711C985.344 121.445 973.391 117.812 957.57 117.812H867.648C864.887 117.812 862.648 120.051 862.648 122.812V284H806.884V177.227H838.622C841.383 177.227 843.622 174.988 843.622 172.227V122.812C843.622 120.051 841.383 117.812 838.622 117.812H713.27C710.509 117.812 708.27 120.051 708.27 122.812V172.227C708.27 174.988 710.509 177.227 713.27 177.227H745.009V284H682.845C680.782 280.476 678.521 277.17 676.06 274.082C670.084 266.465 663.521 259.258 656.373 252.461L620.689 218.184C613.775 211.621 609.146 205.82 606.802 200.781C604.459 195.742 603.287 191.055 603.287 186.719C603.287 182.383 604.4 178.867 606.627 176.172C608.97 173.359 612.603 171.953 617.525 171.953C621.627 171.953 624.849 173.125 627.193 175.469C629.654 177.812 630.884 181.094 630.884 185.312V201.582C630.884 204.343 633.123 206.582 635.884 206.582H688.814C691.575 206.582 693.82 204.339 693.76 201.578C693.14 173.264 687.181 151.963 675.884 137.676C664.048 122.559 643.951 115 615.591 115C592.388 115 574.634 121.914 562.33 135.742C550.142 149.57 544.048 169.668 544.048 196.035C544.048 221.23 554.419 243.613 575.162 263.184L597.088 284H519.652C519.143 282.752 518.59 281.555 517.991 280.41C514.123 272.676 507.327 267.812 497.6 265.82C509.436 261.953 517.463 254.98 521.682 244.902C526.018 234.824 528.186 221.348 528.186 204.473C528.186 187.012 526.78 171.836 523.967 158.945C521.272 145.938 515.881 135.859 507.795 128.711C499.709 121.445 487.756 117.812 471.936 117.812H382.014C379.253 117.812 377.014 120.051 377.014 122.812V284H350.605V122.812C350.605 120.051 348.366 117.812 345.605 117.812H295.839C293.078 117.812 290.839 120.051 290.839 122.812V284H259.281L243.941 122.34C243.698 119.773 241.542 117.812 238.964 117.812H143.111C140.535 117.812 138.381 119.768 138.134 122.332L122.518 284H12.5844L31.6115 153.77Z" fill="white" />
                    <path d="M1603.87 422.188V297H1724V310.5C1724 310.5 1718.49 367.904 1711 404C1710.28 407.482 1709.59 410.826 1708.93 414.056L1708.93 414.058L1708.93 414.061L1708.93 414.062L1708.93 414.064L1708.93 414.066C1702.56 445.078 1698.35 465.568 1685 497C1672.35 526.787 1641.01 544 1608.65 544H1340.61C1345.97 535.842 1349.18 526.856 1349.18 517.262C1349.18 471.096 1278.61 460 1237.38 460C1172.56 460 1102.58 474.86 1051.64 510.723C1039.2 519.513 1028.32 531.086 1020.96 544H897.523C890.347 544 884.633 538.149 883.533 531.057C877.288 490.81 842.498 460 800.531 460C758.547 460 723.756 490.807 717.525 531.05C716.426 538.145 710.712 544 703.533 544H678.992C671.815 544 666.102 538.149 665.002 531.057C658.757 490.81 623.966 460 582 460C540.016 460 505.225 490.807 498.994 531.051C497.895 538.145 492.181 544 485.002 544H127.352C94.9892 544 63.6536 526.787 51 497C37.6459 465.564 33.4396 445.074 27.0724 414.057L27.071 414.051L27.0626 414.009C26.4025 410.794 25.7192 407.466 25 404C17.5093 367.904 12 310.5 12 310.5V297H121.262L109.217 421.707C108.933 424.645 111.242 427.188 114.194 427.188H164.177C166.789 427.188 168.96 425.178 169.162 422.574L172.672 377.266H209.938L213.93 422.626C214.158 425.207 216.32 427.188 218.911 427.188H267.37C270.318 427.188 272.626 424.65 272.348 421.715L260.514 297H290.839V422.188C290.839 424.949 293.078 427.188 295.839 427.188H345.605C348.366 427.188 350.605 424.949 350.605 422.188V297H377.014V422.188C377.014 424.949 379.253 427.188 382.014 427.188H434.592C437.354 427.188 439.592 424.949 439.592 422.188V286.035C447.795 286.035 453.713 287.148 457.346 289.375C461.096 291.484 462.971 297.051 462.971 306.074V422.188C462.971 424.949 465.21 427.188 467.971 427.188H518.967C521.729 427.188 523.967 424.949 523.967 422.188V310.117C523.967 305.403 523.669 301.03 523.073 297H610.56C615.209 301.729 619.054 306.043 622.095 309.941C626.783 315.684 630.064 321.777 631.939 328.223C633.814 334.551 634.752 342.461 634.752 351.953C634.752 359.453 633.638 364.844 631.412 368.125C629.302 371.406 625.435 373.047 619.81 373.047C614.419 373.047 610.611 371.055 608.384 367.07C606.275 362.969 605.22 357.344 605.22 350.195V316.523C605.22 313.762 602.982 311.523 600.22 311.523H549.048C546.287 311.523 544.048 313.762 544.048 316.523V341.758C544.048 372.461 550.259 394.844 562.681 408.906C575.22 422.969 595.611 430 623.853 430C650.455 430 669.087 421.797 679.752 405.391C690.533 388.867 695.923 366.074 695.923 337.012C695.923 322.598 694.107 310.41 690.474 300.449C690.054 299.282 689.617 298.132 689.165 297H745.009V422.188C745.009 424.949 747.247 427.188 750.009 427.188H801.884C804.645 427.188 806.884 424.949 806.884 422.188V297H862.648V422.188C862.648 424.949 864.887 427.188 867.648 427.188H920.227C922.988 427.188 925.227 424.949 925.227 422.188V286.035C933.43 286.035 939.348 287.148 942.981 289.375C946.731 291.484 948.606 297.051 948.606 306.074V422.188C948.606 424.949 950.844 427.188 953.606 427.188H1004.6C1007.36 427.188 1009.6 424.949 1009.6 422.188V310.117C1009.6 305.403 1009.3 301.03 1008.71 297H1036.01V422.188C1036.01 424.949 1038.25 427.188 1041.01 427.188H1158.8C1161.57 427.188 1163.8 424.949 1163.8 422.188V371.895C1163.8 369.133 1161.57 366.895 1158.8 366.895H1103.94C1101.18 366.895 1098.94 364.656 1098.94 361.895V301.055C1098.94 299.386 1099.76 297.908 1101.01 297H1190.31L1178.26 421.707C1177.98 424.645 1180.29 427.188 1183.24 427.188H1233.22C1235.83 427.188 1238.01 425.178 1238.21 422.574L1241.72 377.266H1278.98L1282.98 422.626C1283.2 425.207 1285.36 427.188 1287.96 427.188H1336.42C1339.36 427.188 1341.67 424.65 1341.39 421.715L1329.56 297H1362.7V422.188C1362.7 424.949 1364.94 427.188 1367.7 427.188H1413.6C1416.36 427.188 1418.6 424.949 1418.6 422.188V204.297L1455.51 423.02C1455.92 425.426 1458 427.188 1460.44 427.188H1507.49C1509.95 427.188 1512.04 425.401 1512.43 422.974L1547.27 204.297V422.188C1547.27 424.949 1549.51 427.188 1552.27 427.188H1598.87C1601.63 427.188 1603.87 424.949 1603.87 422.188Z" fill="white" />
                    <path d="M1036.21 544H1231.32C1232.17 541.676 1233 539.395 1233.61 537.67C1233.61 537.622 1233.52 537.483 1233.38 537.272C1232.94 536.603 1232.03 535.212 1232.03 533.707C1232.03 532.518 1243.92 501.807 1245.11 499.627C1245.91 498.439 1246.5 498.042 1248.09 498.042C1251.06 498.042 1255.22 501.411 1255.22 504.779C1255.22 510.253 1251.61 521.005 1249.15 528.313L1249.15 528.325C1248.67 529.742 1248.24 531.028 1247.89 532.122C1246.41 536.081 1244.97 540.041 1243.53 544H1324.2C1332.07 534.837 1337.09 524.155 1337.09 512.11C1337.09 476.049 1272.86 469.511 1242.14 469.511C1217.36 469.511 1192.38 471.69 1168 476.644C1121.11 485.982 1063.31 506.713 1036.21 544Z" fill="white" />
                    <path d="M177.066 327.871H205.191L191.656 170.547H188.844L177.066 327.871Z" fill="white" />
                    <path d="M439.944 232.422H454.885C463.44 232.422 467.717 223.105 467.717 204.473C467.717 192.402 466.78 184.492 464.905 180.742C463.03 176.992 459.514 175.117 454.358 175.117H439.944V232.422Z" fill="white" />
                    <path d="M925.578 232.422H940.52C949.074 232.422 953.352 223.105 953.352 204.473C953.352 192.402 952.414 184.492 950.539 180.742C948.664 176.992 945.148 175.117 939.992 175.117H925.578V232.422Z" fill="white" />
                    <path d="M1274.24 327.871H1246.11L1257.89 170.547H1260.7L1274.24 327.871Z" fill="white" />
                    <path class="flicker" d="M1020.96 544C1014.72 554.956 1011 566.878 1011 578.882C1011 603.253 1024.48 621.878 1050.84 630.992C1054.81 632.379 1064.13 635.153 1068.09 635.153C1069.48 635.153 1070.47 634.361 1070.47 633.172C1070.47 630.794 1067.89 629.209 1065.71 628.615C1063.85 628.02 1062 627.51 1060.14 626.999C1057.04 626.147 1053.94 625.296 1050.84 624.058C1030.82 616.528 1021.9 603.649 1021.9 584.628C1021.9 574.92 1024.28 565.013 1028.84 556.097C1030.94 551.884 1033.41 547.853 1036.21 544H1020.96Z" fill="white" />
                    <path class="flicker" fill-rule="evenodd" clip-rule="evenodd" d="M1231.32 544H1243.53C1243.13 545.093 1242.73 546.186 1242.34 547.279C1240.5 552.332 1238.67 557.384 1236.79 562.437C1241.94 568.975 1243.72 577.297 1243.72 586.808C1243.72 600.876 1239.17 614.943 1234.01 627.822C1231.63 633.964 1222.12 654.967 1214.98 654.967C1205.07 654.967 1201.5 646.447 1201.5 638.125C1201.5 627.426 1208.04 607.81 1211.81 597.507C1216.37 584.628 1225.69 559.069 1225.69 559.069L1227.47 554.511C1227.47 554.511 1229.45 549.15 1231.32 544ZM1236.39 580.864C1236.39 576.901 1235.8 572.938 1234.41 569.174C1234.01 570.263 1233.61 571.403 1233.22 572.542C1232.82 573.681 1232.43 574.82 1232.03 575.91C1231.26 577.965 1230.36 580.319 1229.38 582.897L1229.38 582.898C1222.49 600.961 1211.41 630.025 1211.41 644.069V645.456C1215.38 641.89 1218.55 636.342 1221.13 631.785C1229.45 616.727 1236.39 598.102 1236.39 580.864Z" fill="white" />
                    <path class="flicker" d="M1324.2 544H1340.61C1328.92 561.788 1307.01 575.634 1285.95 583.241C1302.6 588.789 1312.31 601.668 1312.31 620.293C1312.31 652.787 1248.48 694 1197.93 694C1179.1 694 1160.86 686.075 1160.86 667.648C1160.86 657.939 1166.41 651.004 1169.98 651.004C1172.16 651.004 1173.55 652.589 1173.55 654.373C1173.55 655.046 1173.19 655.568 1172.69 656.29C1171.58 657.903 1169.78 660.514 1169.78 668.044C1169.78 681.517 1177.91 684.688 1191.99 684.688C1228.66 684.688 1300.42 651.797 1300.42 615.736C1300.42 598.3 1291.1 589.978 1271.08 589.978C1268.78 589.978 1266.57 590.231 1264.39 590.482C1262.26 590.726 1260.15 590.969 1258 590.969C1254.23 590.969 1249.67 587.6 1249.67 584.232C1249.67 582.647 1250.46 581.656 1252.25 581.26C1253.44 580.934 1254.7 580.668 1255.98 580.396C1257.04 580.172 1258.11 579.944 1259.19 579.675C1280.56 574.899 1308.24 562.571 1324.2 544Z" fill="white" />
                    <path class="flicker" d="M1374.01 578.684C1386.7 578.684 1396.81 586.015 1396.81 592.752C1396.81 594.337 1395.81 595.328 1394.03 595.328C1391.48 595.328 1390.54 594.036 1389.43 592.522C1387.86 590.382 1385.97 587.798 1378.77 587.798C1363.9 587.798 1348.63 608.999 1348.63 626.633C1353.99 626.633 1373.22 604.244 1379.76 595.922C1380.35 595.13 1381.14 594.931 1382.14 594.931C1385.31 594.931 1390.26 599.092 1389.07 602.659C1388.97 602.963 1388.86 603.266 1388.75 603.568L1388.73 603.644C1386.47 610.018 1384.32 616.094 1384.32 623.067C1384.32 624.058 1384.71 624.454 1385.51 624.454C1396.34 624.644 1418.28 604.445 1430.03 592.474C1432.01 587.01 1433.58 582.295 1433.58 580.666C1433.58 579.08 1434.97 578.486 1436.76 578.486C1439.73 578.486 1443.89 581.854 1443.89 585.223C1443.89 588.007 1441.11 595.382 1439.23 600.368L1439.23 600.37C1438.7 601.769 1438.25 602.979 1437.94 603.848C1439.93 600.083 1458.76 577.693 1462.53 577.693C1465.9 577.693 1469.86 581.458 1469.86 584.628C1469.86 585.45 1469.05 587.148 1468 589.37C1466.01 593.576 1463.12 599.66 1463.12 605.235C1463.12 607.612 1463.91 608.603 1465.3 608.603C1473.59 608.603 1483.76 599.357 1489.69 593.964C1492.14 591.743 1493.86 590.176 1494.44 590.176C1496.62 590.176 1499 592.356 1499 594.337C1499 594.931 1498.8 595.13 1498.41 595.526C1492.26 603.055 1478.98 616.33 1468.67 616.33C1458.76 616.33 1454 608.405 1454 599.29C1454 598.498 1454 597.705 1454.2 596.913C1444.49 608.801 1435.76 622.274 1428.03 634.559C1427.04 635.946 1426.45 636.54 1424.86 636.54C1421.89 636.54 1417.72 633.172 1417.72 629.804C1417.72 627.072 1421.11 617.042 1423.14 611.234C1412.3 622.201 1398.42 633.37 1388.48 633.37C1380.35 633.37 1375.79 627.624 1374.6 619.897C1374.47 620.052 1374.33 620.211 1374.19 620.372C1374.01 620.579 1373.83 620.791 1373.64 621.007L1373.61 621.042C1368.21 627.278 1360.02 636.738 1352 636.738C1343.08 636.738 1338.33 628.615 1338.33 620.491C1338.33 603.253 1355.37 578.684 1374.01 578.684Z" fill="white" />
                </svg>
                <div class="hamburger-menu no-transition flex items-center h-10 w-10 col-start-3 justify-self-end mr-2 scale-50" data-menu="3">
                    <div class="icon w-10 h-1 before:w-10 before:h-1 after:w-10 after:h-1"></div>
                </div>
                <div id="menu-container" class="no-transition section-menu px-2 pb-2 hidden fixed w-full bg-black mt-20 top-0">
                    <div class="section-inner h-[calc(100vh-5.5rem)] h-[calc(100dvh-5rem)] rounded p-3 border-l-gray-950/25 grid grid-rows-[auto_1fr] items-center justify-center">
                        <div class="open-closed">
                            <p class="open-closed-text text-white font-light">
                                <?php echo $barOpeningHourScript; ?>
                            </p>
                        </div>
                        <div class="menu-items flex flex-col justify-center items-center gap-1 transform -translate-y-[5.724svh]">
                            <!--
                        388px to page top is
                        290px to page bottom is
                        total 678

                        should be 339px to page top/bottom
                        49px too much

                        273px to next element above is
                        224px to next element above should


                        49px = x% -> 5.7242990654 -> 5.7% top margin too much
                        856px (whole page height) = 100%

                        5.724 svh only if none of the elements change
                        (e.g if a menu item is added or removed/the gap between items changes this needs to be changed as well)
                        -->
                            <a href="ueber-uns" class="font-sans tracking-normal font-normal text-2xl text-white w-44 no-transition opacity-0">
                                Über uns
                            </a>
                            <a href="getraenke" class="font-sans tracking-normal font-normal text-2xl text-white w-44 no-transition opacity-0">
                                Getränke
                            </a>
                            <a href="bar-mieten" class="font-sans tracking-normal font-normal text-2xl text-white w-44 no-transition opacity-0">
                                Mieten
                            </a>
                            <a href="aktuelles" class="font-sans tracking-normal font-normal text-2xl text-white w-44 no-transition opacity-0">
                                Aktuelles
                                <!-- Kurse? -->
                            </a>
                            <a href="airbnb" class="font-sans tracking-normal font-normal text-2xl text-white w-44 no-transition opacity-0">
                                Airbnb
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-test mt-20 px-2 pb-2">
                <div class="section-inner main-content rounded p-3">
                    <?php
                        $filenameWithoutExtension = basename(__FILE__, '.php');
                        include "content/{$filenameWithoutExtension}-content.php";
                    ?>
                </div>
            </div>
            <!-- <div class="content snap-y snap-mandatory h-screen overflow-y-scroll bg-black mt-20 select-none text-white">
                <div class="section-one snap-normal snap-start px-2 pb-2">
                    <div class="section-inner main-content h-[calc(100vh-5.5rem)] h-[calc(100dvh-5.5rem)] rounded p-3 border border-solid border-fuchsia-300/50">
                        Testing
                    </div>
                </div>
                <div class="section-two snap-normal snap-start px-2 pb-2">
                    <div class="section-inner h-[calc(100vh-5.5rem)] h-[calc(100dvh-5.5rem)] rounded p-3 border border-solid border-teal-200/50">
                        <h2 class="font-sans tracking-wide uppercase font-semibold text-2xl text-white">
                                Milky way
                        </h2>
                    </div>
                </div>
                <div class="section-three snap-normal snap-start px-2 pb-2">
                    <div class="section-inner h-[calc(100vh-5.5rem)] h-[calc(100dvh-5.5rem)] rounded p-3 border border-solid border-sky-800">
                        <h2 class="font-sans tracking-wide uppercase font-semibold text-2xl text-white">
                                New generation
                        </h2>
                    </div>
                </div>
            </div> -->
        </div>
        <script src="/js/app.js"></script>
    </body>

    </html>
<?php
} // end of the PHP block
?>