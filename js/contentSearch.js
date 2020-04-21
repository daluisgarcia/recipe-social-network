
const RECIPE_IMG_FOLDER = 'recipes_img/';

function validate(search, category, feature){
    if (search == ''){
        return false
    }else if(category == ''){
        return false
    }else if(feature == ''){
        return false
    }
    return true
}

function sanitize(string){
    let element = document.createElement('div')
    element.innerHTML = string
    return element.innerText.trim()   //Limpia el texto y evita insersion de codigo html
}

function removeAllChilds(element) {
    let child = element.lastChild;
    while(child){
        element.removeChild(child);
        child = element.lastChild;
    }
}

//CREACION DE LOS CUADROS HTML DE CADA RECETA
function showContent(data){
    let card = document.createElement('div')
    card.classList.add('card', 'shadow-sm', 'mb-3', 'col-12')

        let row1 = document.createElement('div')    //Contine la imagen, titulo, nombre de usuario y fecha (col1 y col2)
        row1.classList.add('row', 'no-gutters', 'border-bottom')

            let col1 = document.createElement('div')
            col1.classList.add('col-md-4')

                let img_link = document.createElement('a')
                img_link.href = `recipe.php?id=${data.id}`

                    let img = document.createElement('img')
                    img.classList.add('card-img-left', 'form-img')
                    img.setAttribute('src', RECIPE_IMG_FOLDER+data.image_path)
                    img.setAttribute('alt', `Foto de ${data}`)

                img_link.appendChild(img)

            col1.appendChild(img_link)

            let col2 = document.createElement('div')
            col2.classList.add('col-md-8')

                let card_body = document.createElement('div')
                card_body.classList.add('card-body')

                    let title_container = document.createElement('div')
                    title_container.classList.add('border-bottom')

                        let title_link = document.createElement('a')
                        title_link.href = `recipe.php?id=${data.id}`

                            let title = document.createElement('h2')
                            title.classList.add('card-title', 'font-weight-bold', 'text-dark')
                            title.innerText = data.title

                        title_link.appendChild(title)

                    title_container.appendChild(title_link)

                    let varius = document.createElement('div')
                    varius.classList.add('row', 'card-text', 'mt-2')

                        let col1_inter = document.createElement('div')
                        col1_inter.classList.add('col-5')

                            let ingre_title = document.createElement('h4')
                            ingre_title.classList.add('ml-2')
                            ingre_title.innerText = 'Ingredientes'

                            let ingre_list = document.createElement('ul')
                            ingre_list.innerHTML = data.ingredients

                        col1_inter.appendChild(ingre_title)
                        col1_inter.appendChild(ingre_list)

                        let col2_inter = document.createElement('div')
                        col2_inter.classList.add('col-7')

                            let step_title = document.createElement('h4')
                            step_title.classList.add('ml-2')
                            step_title.innerText = 'Pasos a seguir:'

                            let step_list = document.createElement('ol')
                            step_list.innerHTML = data.steps

                        col2_inter.appendChild(step_title)
                        col2_inter.appendChild(step_list)

                    varius.appendChild(col1_inter)
                    varius.appendChild(col2_inter)

                card_body.appendChild(title_container)
                card_body.appendChild(varius)

            col2.appendChild(card_body)

        row1.appendChild(col1)
        row1.appendChild(col2)

        let row2 = document.createElement('div')
        row2.classList.add('card-body')

            let comments = document.createElement('div')
            comments.classList.add('m-2')
            comments.innerText = data.comments

        row2.appendChild(comments)

        let row3 = document.createElement('div')
        row3.classList.add('card-footer', 'text-muted')

            let row_inter = document.createElement('div')
            row_inter.classList.add('row')

                let user = document.createElement('a')
                user.classList.add('col-6')
                user.href = '#' //LINK AL PERFIL DEL AUTOR
                user.innerText = data.username

                let date_container = document.createElement('div')
                date_container.classList.add('col-6', 'text-right')

                    let date = document.createElement('small')
                    date.innerText = data.date

                date_container.appendChild(date)

            row_inter.appendChild(user)
            row_inter.appendChild(date_container)

        row3.appendChild(row_inter)

    card.appendChild(row1)
    card.appendChild(row2)
    card.appendChild(row3)

    return card
}

//var loader;

document.getElementById('search-btn').addEventListener('click', function (event) {

    event.preventDefault() //IMPIDE QUE SE ENVIE EN FORMULARIO AUTOMATICAMENTE

    let search = document.getElementById("search").value,
        category = document.getElementById("category").value,
        feature = document.getElementById("feature").value

    search = sanitize(search)

    if(validate(search, category, feature)){

        //QUITA EL MENSAJE DE 'NO SE HAN ENCONTRADO RESULTADOS'
        removeAllChilds(document.getElementById('no-content'))

        let peticion = new XMLHttpRequest()
        let params = `feature=${feature}&category=${category}&search=${search}`   //PARTE DE LA URL QUE DEFINE LOS ELEMENTOS DE GET
        peticion.open('GET', `./search.php?${params}`)

        peticion.send()

        //loader.classList.add('active');

        peticion.onreadystatechange = function(){
            if(peticion.readyState == 4 && peticion.status == 200){
                //loader.classList.remove('active')
            }
        }

        peticion.onload = function(){
            let data = JSON.parse(peticion.responseText)
            let container = document.getElementById('content');
            removeAllChilds(container);
            if(data.error){
                let element = document.createElement('p')
                element.innerText = data.error
                document.getElementById('no-content').appendChild(element)
            }else{
                for(let i = 0; i < data.length; i++){
                    container.appendChild(showContent(data[i]))
                }
            }
            document.getElementById("search").value = ""
            document.getElementById("category").value = "default"
            document.getElementById("feature").value = "default"
        }


    }

})