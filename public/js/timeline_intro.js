
let firstInter = setInterval(swapText, 7000);
let splashScreen = document.getElementById("splashScreen");
let categoryList = document.getElementById("categoryList");
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
    clearInterval(firstInter);
    if (typeof secondInter !== 'undefined')
        clearInterval(secondInter);
    categoryList.style.display = "flex";
}

function swapText() {

    if (firstText != null) {

        categoryList.style.display = "none";
        if (counter + 2 < (categoryArray.length)) {
            counter = counter + 2;

            if (flag == 1) {
                clearInterval(firstInter);
                document.getElementById("splashScreen").style.display = "none";
                categoryList.style.display = "flex";
            }

            if (categoryArray[categoryArray.length - 1] == categoryArray[counter])
                flag = 1;

            firstText.textContent = categoryArray[counter];

            if (imageCounter > imageArray.length - 1)
                imageCounter = 0;

            topLeftImage.animate(
                [
                    { filter: 'opacity(0)'},
                    { filter: 'opacity(100)', offset: 0.2},
                    { filter: 'opacity(100)', offset: 0.7},
                    { filter: 'opacity(0)'}
                ], {
                    duration: 3550,
                    iterations: 1
                }
            )
            topLeftImage.src = "../../images/home/" + imageArray[imageCounter]

            imageCounter++;

            if (imageCounter > imageArray.length - 1)
                imageCounter = 0;

            topRightImage.animate(
                [
                    { filter: 'opacity(0)'},
                    { filter: 'opacity(100)', offset: 0.2},
                    { filter: 'opacity(100)', offset: 0.7},
                    { filter: 'opacity(0)'}
                ], {
                    duration: 3550,
                    iterations: 1
                }
            )
            topRightImage.src = "../../images/home/" + imageArray[imageCounter]

            imageCounter++;

            if (imageCounter > imageArray.length - 1)
                imageCounter = 0;

            bottomLeftImage.animate(
                [
                    { filter: 'opacity(0)'},
                    { filter: 'opacity(100)', offset: 0.2},
                    { filter: 'opacity(100)', offset: 0.7},
                    { filter: 'opacity(0)'}
                ], {
                    duration: 3550,
                    iterations: 1
                }
            )
            bottomLeftImage.src = "../../images/home/" + imageArray[imageCounter]

            imageCounter++;

            if (imageCounter > imageArray.length - 1)
                imageCounter = 0;

            bottomRightImage.animate(
                [
                    { filter: 'opacity(0)'},
                    { filter: 'opacity(100)', offset: 0.2},
                    { filter: 'opacity(100)', offset: 0.7},
                    { filter: 'opacity(0)'}
                ], {
                    duration: 3550,
                    iterations: 1
                }
            )
            bottomRightImage.src = "../../images/home/" + imageArray[imageCounter]

            imageCounter++;

        } else {
            if (flag == 1) {
                clearInterval(firstInter);
                document.getElementById("splashScreen").style.display = "none";
                categoryList.style.display = "flex";
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
                categoryList.style.display = "flex";
            }

            if (categoryArray[categoryArray.length - 1] == categoryArray[secondCounter])
                flag = 1;

            secondText.textContent = categoryArray[secondCounter];

            if (imageCounter > imageArray.length - 1)
                imageCounter = 0;

            topLeftImage.animate(
                [
                    { filter: 'opacity(0)'},
                    { filter: 'opacity(100)', offset: 0.2},
                    { filter: 'opacity(100)', offset: 0.7},
                    { filter: 'opacity(0)'}
                ], {
                    duration: 3550,
                    iterations: 1
                }
            )
            topLeftImage.src = "../../images/home/" + imageArray[imageCounter]

            imageCounter++;

            if (imageCounter > imageArray.length - 1)
                imageCounter = 0;

            topRightImage.animate(
                [
                    { filter: 'opacity(0)'},
                    { filter: 'opacity(100)', offset: 0.2},
                    { filter: 'opacity(100)', offset: 0.7},
                    { filter: 'opacity(0)'}
                ], {
                    duration: 3550,
                    iterations: 1
                }
            )
            topRightImage.src = "../../images/home/" + imageArray[imageCounter]

            imageCounter++;

            if (imageCounter > imageArray.length - 1)
                imageCounter = 0;

            bottomLeftImage.animate(
                [
                    { filter: 'opacity(0)'},
                    { filter: 'opacity(100)', offset: 0.2},
                    { filter: 'opacity(100)', offset: 0.7},
                    { filter: 'opacity(0)'}
                ], {
                    duration: 3550,
                    iterations: 1
                }
            )
            bottomLeftImage.src = "../../images/home/" + imageArray[imageCounter]

            imageCounter++;

            if (imageCounter > imageArray.length - 1)
                imageCounter = 0;

            bottomRightImage.animate(
                [
                    { filter: 'opacity(0)'},
                    { filter: 'opacity(100)', offset: 0.2},
                    { filter: 'opacity(100)', offset: 0.7},
                    { filter: 'opacity(0)'}
                ], {
                    duration: 3550,
                    iterations: 1
                }
            )
            bottomRightImage.src = "../../images/home/" + imageArray[imageCounter]

            imageCounter++;

        } else {

            if (flag == 1) {
                clearInterval(firstInter);
                document.getElementById("splashScreen").style.display = "none";
                categoryList.style.display = "flex";
            }
        }
    } else
        clearInterval(secondInter);
}