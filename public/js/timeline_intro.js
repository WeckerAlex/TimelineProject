$(document).ready( function() {

    let firstInter = setInterval(swapText, 7000);
    let splashScreen = document.getElementById("splashScreen");
    let firstText = document.getElementById("firstTextAnimation");
    let secondText = document.getElementById("secondTextAnimation");
    let topLeftImage = document.getElementById("topLeftImage");
    let topRightImage = document.getElementById("topRightImage");
    let bottomLeftImage = document.getElementById("bottomLeftImage");
    let bottomRightImage = document.getElementById("bottomRightImage");
    let skip = document.getElementById("skip");
    let counter = -2;
    let secondCounter = -1;
    let flag = 0;
    let imageCounter = 0;


    function removeSplash() {
        document.getElementById("splashScreen").style.display = "none";
    }

    function swapText() {

        if (firstText != null) {

            if (counter + 2 < (categoryArray.length)) {
                counter = counter + 2;

                if (flag == 1) {
                    clearInterval(firstInter);
                    document.getElementById("splashScreen").style.display = "none";
                }

                if (categoryArray[categoryArray.length - 1] == categoryArray[counter])
                    flag = 1;

                firstText.textContent = categoryArray[counter];

                if (imageCounter > imageArray.length - 1)
                    imageCounter = 0;

                topLeftImage.src = "../../images/home/" + imageArray[imageCounter]

                imageCounter++;

                if (imageCounter > imageArray.length - 1)
                    imageCounter = 0;

                topRightImage.src = "../../images/home/" + imageArray[imageCounter]

                imageCounter++;

                if (imageCounter > imageArray.length - 1)
                    imageCounter = 0;

                bottomLeftImage.src = "../../images/home/" + imageArray[imageCounter]

                imageCounter++;

                if (imageCounter > imageArray.length - 1)
                    imageCounter = 0;

                bottomRightImage.src = "../../images/home/" + imageArray[imageCounter]

                imageCounter++;

            } else {
                if (flag == 1) {
                    clearInterval(firstInter);
                    document.getElementById("splashScreen").style.display = "none";
                }
            }
        } else
            clearInterval(firstInter);
    }

    swapText();

    setTimeout(function () {
        globalThis.secondInter = setInterval(swapSecondText, 7000);
        swapSecondText();
    }, 3500);

    function swapSecondText() {

        if (secondText != null) {

            if (secondCounter + 2 < (categoryArray.length)) {

                secondCounter = secondCounter + 2;

                if (flag == 1) {
                    clearInterval(firstInter);
                    document.getElementById("splashScreen").style.display = "none";
                }

                if (categoryArray[categoryArray.length - 1] == categoryArray[secondCounter])
                    flag = 1;

                secondText.textContent = categoryArray[secondCounter];

                if (imageCounter > imageArray.length - 1)
                    imageCounter = 0;

                topLeftImage.src = "../../images/home/" + imageArray[imageCounter]

                imageCounter++;

                if (imageCounter > imageArray.length - 1)
                    imageCounter = 0;

                topRightImage.src = "../../images/home/" + imageArray[imageCounter]

                imageCounter++;

                if (imageCounter > imageArray.length - 1)
                    imageCounter = 0;

                bottomLeftImage.src = "../../images/home/" + imageArray[imageCounter]

                imageCounter++;

                if (imageCounter > imageArray.length - 1)
                    imageCounter = 0;

                bottomRightImage.src = "../../images/home/" + imageArray[imageCounter]

                imageCounter++;

            } else {

                if (flag == 1) {
                    clearInterval(firstInter);
                    document.getElementById("splashScreen").style.display = "none";
                }
            }
        } else
            clearInterval(secondInter);
    }

});