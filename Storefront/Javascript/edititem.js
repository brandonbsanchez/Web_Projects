const edit_buttons = document.querySelectorAll('.edit_item');

for(let i = 0 ; i < edit_buttons.length ; i++) {
    edit_buttons[i].addEventListener('click', edit_item);
}

function edit_item(event) { //Changes text to form inputs
    //Getting values from page to change to input boxes
    const item_id = event.target.value
    const css_id = `item_${item_id}`;
    const item_card = document.querySelector(`#${css_id}`);
    const item_name = item_card.querySelector('h2').innerHTML;
    const descr = item_card.querySelector('.description').innerHTML;
    const num_in_stock = item_card.querySelector('.num_in_stock').innerHTML;
    const unit_price = item_card.querySelector('.unit_price').innerHTML;
    const img_loc = item_card.querySelector('img').src;

    item_card.innerHTML = `<div class="item_card" id="item_${item_id}">
    <form method="POST" action="Includes/edititem_inc.php" enctype="multipart/form-data">
        <p>Item Name:</p>
        <input type="text" value="${item_name}" name="item_name">
        <p>Description:</p>
        <input type="text" value="${descr}" name="descr">
        <p>Quantity:</p>
        <input type="text" value="${num_in_stock}" name="num_in_stock">
        <p>Unit Price:</p>
        <input type="text" value="${unit_price}" name="unit_price">
        <p>Image (png, jpg, jpeg)</p>
        <img src="${img_loc}" height=50px><br>
        <input type="file" name="file"><br>
        <button type="submit" name="edit_item" value=${item_id}>Save Changes</button>
    </form>
    <button class="revert" type="button" value=${item_id}'>Revert</button>
    <p>Add Items</p>
    <form method="POST" action="Includes/deleteitem_inc.php">
    <button type="submit" name="delete_item" value=${item_id}>Delete item</button>
    </form>
    </div>`; //Changes item card to a form with inputs to change values

    const revert_button = item_card.querySelector('.revert');

    revert_button.addEventListener('click', function() { //Allow revert functionality
        revert(css_id, item_id, item_name, descr, img_loc, num_in_stock, unit_price);
    })
}

function revert(css_id, item_id, item_name, descr, img_loc, num_in_stock, unit_price) {
    const new_item_card = document.querySelector(`#${css_id}`); //Re-get item card

    new_item_card.innerHTML = `<div class="item_card" id="item_${item_id}">
                        <h2>${item_name}</h2>
                        <p class="description">${descr}</p>
                        <p class="num_in_stock">${num_in_stock}</p>
                        <p class="unit_price">${unit_price}</p>
                        <img src="${img_loc}" height=50px><br>
                        <button class="edit_item" type="button" value=${item_id}>Edit Item</button>
                        <form method="POST" action="Includes/deleteitem_inc.php">
                        <button type="submit" name="delete_item" value=${item_id}>Delete Item</button>
                        </form>
                        </div>`; //Reverts item card back to static text
    
    new_item_card.querySelector('.edit_item').addEventListener('click', edit_item);
}
