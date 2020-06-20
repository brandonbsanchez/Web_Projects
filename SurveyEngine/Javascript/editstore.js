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

    store_card.innerHTML = `<div class="store_card margin_fix" id="store_${store_id}">
    <h2>Edit Store</h2>
    <div class="form edit_form">
    <form method="POST" action="Includes/editstore_inc.php" enctype="multipart/form-data">
        <p class="store_name">Store Name</p>
        <input class="input" type="text" value="${store_name}" name="store_name">
        <p class="store_descr">Description</p>
        <input class="input" type="text" value="${descr}" name="descr">
        <img class="edit_image" src="${img_loc}" height=50px>
        <input type="file" name="file"><br>
        <button class="revert button" type="button" value=${store_id}'>Revert</button>
        <button class="button save_changes" type="submit" name="edit_store" value=${store_id}>Save Changes</button><br>
    </form>
    </div>
    </div>`; //Changes store card to a form with inputs to change values

    const revert_button = store_card.querySelector('.revert');

    revert_button.addEventListener('click', function() { //Allow revert functionality
        revert(css_id, store_id, store_name, descr, img_loc);
    })
}
function revert(css_id, store_id, store_name, descr, img_loc) {
    const new_store_card = document.querySelector(`#${css_id}`); //Re-get store card

    new_store_card.innerHTML = `<div class="store_card margin_fix" id="store_${store_id}">
                        <h2>${store_name}</h2>
                        <div class="bottom_card">
                        <p>${descr}</p>
                        <img src="${img_loc}" height=80px>
                        <form method="POST">
                        <button class="edit_store button" type="button" value=${store_id}>Edit Store</button>
                        </form>
                        <form method="POST" action="additems.php">
                        <button class="add_item button" type="submit" name="add_item" value=${store_id}>Add Questions</button>
                        </form>
                        <form method="POST" action="Includes/deletestore_inc.php">
                        <button class="delete button" type="submit" name="delete_store" value=${store_id}>Delete Store</button>
                        </form>
                        </div>
                        </div>`; //Reverts store card back to static text
    
    new_store_card.querySelector('.edit_store').addEventListener('click', edit_store);
}
