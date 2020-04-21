
function sanitize(string){
    var element = document.createElement('div');
    element.innerHTML = string;
    return element.innerText.trim();   //Limpiza insercion de etiquetas html
}

function removeAllChilds(element) {
    let child = element.lastChild;
    while(child){
        element.removeChild(child);
        child = element.lastChild;
    }
}

function validate_blank(title, ingredients, steps){
    removeAllChilds(document.getElementById("error-zone"));
    let list = document.getElementById('error-zone');
    let validated = true;
    if (title === ''){
        let element = document.createElement('li');
        element.innerText = 'Debe llenar título de la receta.';
        list.appendChild(element);
        validated = false;
    }
    if(!ingredients.length){
        let element = document.createElement('li');
        element.innerText = 'Debe colocar al menos un ingrediente.';
        list.appendChild(element);
        validated = false;
    }
    if(!steps.length){
        let element = document.createElement('li');
        element.innerText = 'Debe colocar al menos un paso.';
        list.appendChild(element);
        validated = false;
    }
    return validated;
}

function addItem(listId, inputId){
    let value = document.getElementById(inputId).value;
    value = sanitize(value);
    if (value !== ''){
        let element = document.createElement('li');
        let div = document.createElement('div');
        div.classList.add('row');
        element.appendChild(div);
        let span = document.createElement('span');
        span.classList.add('col-11', 'p-3');
        span.innerHTML = sanitize(value);
        div.appendChild(span);
        addTrashButton(div);
        document.getElementById(listId).appendChild(element);
    }
    document.getElementById(inputId).value = '';
}

function addTrashButton(element) {
    let button = document.createElement('div');
    button.classList.add('btn', 'btn-light', 'col-1', 'p-1', 'text-center', 'my-auto');
    button.setAttribute('onclick', 'removeOption(this)');
    let img = document.createElement('img');
    img.classList.add('form-img');
    img.setAttribute('src', './img/trash-icon.svg');
    button.appendChild(img);
    element.appendChild(button);
}

function cleanItems(element){
    let childNumber = element.children.length;
    let child = element.firstChild;
    if (childNumber > 0) {
        for (let i = 0; i < childNumber; i++) {
            if (child) {
                let text = child.firstChild.firstChild.innerText;
                removeAllChilds(child);
                child.innerText = sanitize(text);
                child = child.nextSibling;
            }
        }
    }
}

function removeOption(element){
    element.parentNode.parentNode.remove();
}


/*
*   PREVENCION DE EVENTO SUBMIT EN BOTON DE AGREGAR RECETA PARA VALIDAR Y PODER ENVIAR LOS ELEMENTOD DE INGREDIENTES Y PASOS
 */
document.getElementById('add-recipe-form').addEventListener('submit', function(event){

    event.preventDefault(); //Se evita que se mande el formulario
    let ingredientsList = document.getElementById('ingredients-list'),
        stepsList = document.getElementById('steps-list');

    
    //Creacion de todos los campos para comprobar si estan vacios
    let title = document.getElementById('title').value.trim(),
        ingredients = ingredientsList.children, //PASO LOS HIJOS PARA VERIFICAR QUE EXISTA AL MENOS UNO
        steps = stepsList.children;

    let comments = document.getElementById('comments').value.trim();

    if(validate_blank(title, ingredients, steps)){
        title = sanitize(title);
        comments = sanitize(comments);
        document.getElementById('title').value = title;
        document.getElementById('comments').value = comments;
        cleanItems(ingredientsList);
        ingredients = ingredientsList.innerHTML;
        document.getElementById('ingredients').value = ingredients;
        cleanItems(stepsList);
        steps = stepsList.innerHTML;
        document.getElementById('steps').value = steps;
        this.submit();  //Se manda el formulario si todo es correcto
    }
});