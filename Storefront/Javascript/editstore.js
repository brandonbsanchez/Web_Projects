const edit_buttons = document.querySelectorAll('.edit_store');

for(let i = 0 ; i < edit_buttons.length ; i++) {
    edit_buttons[i].addEventListener('click', edit_store);
}

function edit_store(event) { //Changes text to form inputs
    //Getting values from page to change to input boxes
    const store_id = event.target.value
    const css_id = `store_${store_id}`;
    const store_card = document.querySelector(`#${css_id}`);
    const store_name = store_card.querySelector('h2').innerHTML;
    const descr = store_card.querySelector('p').innerHTML;
    const img_loc = store_card.querySelector('img').src;

    store_card.innerHTML = `<div class="store_card" id="store_${store_id}">
    <form method="POST" action="Includes/editstore_inc.php" enctype="multipart/form-data">
        <p>Store Name:</p>
        <input type="text" value="${store_name}" name="store_name">
        <p>Description:</p>
        <input type="text" value=${descr}" name="descr">
        <p>Image (png, jpg, jpeg)</p>
        <img src="${img_loc}" height=50px><br>
        <input type="file" name="file"><br>
        <input type="submit" value="Save Changes">
    </form>
    <button class="revert" type="button" value=${store_id}'>Revert</button>
    <p>Add Items</p>
    <form method="POST" action="Includes/deletestore_inc.php">
    <button type="submit" name="delete_store" value=${store_id}>Delete Store</button>
    </form>
    </div>`; //Changes store card to a form with inputs to change values

    const revert_button = store_card.querySelector('.revert');

    revert_button.addEventListener('click', function() { //Allow revert functionality
        revert(css_id, store_id, store_name, descr, img_loc);
    })
}

function revert(css_id, store_id, store_name, descr, img_loc) {
    const new_store_card = document.querySelector(`#${css_id}`); //Re-get store card

    new_store_card.innerHTML = `<div class="store_card" id="store_${store_id}">
                        <h2>${store_name}</h2>
                        <p>${descr}</p>
                        <img src="${img_loc}" height=50px>
                        <form method="POST">
                        <button class="edit_store" type="button" value=${store_id}>Edit Store</button>
                        </form>
                        <p>Add Items</p>
                        <form method="POST" action="Includes/deletestore_inc.php">
                        <button type="submit" name="delete_store" value=${store_id}>Delete Store</button>
                        </form>
                        </div>`; //Reverts store card back to static text
    
    new_store_card.querySelector('.edit_store').addEventListener('click', edit_store);
}
