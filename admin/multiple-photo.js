let fileInput = document.getElementById("file-input");
let imageContainer = document.getElementById("image-container");
let numOfFiles = document.getElementById("num-of-files");

function preview(){

    imageContainer.innerHTML = "";
    numOfFiles.textContent = `${fileInput.files.length}
    Files Selected`;

    for(i of fileInput.files){
        let reader = new FileReader();
        let figure = document.createElement("figure");
        let figCap = document.createElement("figcaption");

        figCap.innerText = i.names;
        figure.appendChild(figCap);
        reader.onload=()=>{
            let img = document.createElement("img");
            img.setAttribute("src", reader.result);
            figure.insertBefore(img, figCap);
        }

        imageContainer.appendChild(figure);
        reader.readAsDataURL(i)
    }

}