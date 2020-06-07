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

    item_card.innerHTML = `<div class="store_card margin_fix" id="item_${item_id}">
    <h2>Edit Item</h2>
    <div class="form edit_item_form">
    <form method="POST" action="Includes/edititem_inc.php" enctype="multipart/form-data">
        <p class="store_name">Item Name</p>
        <input class="input" type="text" value="${item_name}" name="item_name">
        <p class="store_descr">Description</p>
        <input class="input" type="text" value="${descr}" name="descr">
        <p class="store_descr">Quantity</p>
        <input class="input" type="text" value="${num_in_stock}" name="num_in_stock">
        <p class="store_descr">Unit Price</p>
        <input class="input" type="text" value="${unit_price}" name="unit_price">
        <img class="edit_image" src="${img_loc}" height=50px><br>
        <input type="file" name="file"><br>
        <button class="revert button" type="button" value=${item_id}'>Revert</button>
        <button class="button save_changes" type="submit" name="edit_item" value=${item_id}>Save Changes</button>
    </form>
    </div>
    </div>`; //Changes item card to a form with inputs to change values

    const revert_button = item_card.querySelector('.revert');

    revert_button.addEventListener('click', function() { //Allow revert functionality
        revert(css_id, item_id, item_name, descr, img_loc, num_in_stock, unit_price);
    })
}

function revert(css_id, item_id, item_name, descr, img_loc, num_in_stock, unit_price) {
    const new_item_card = document.querySelector(`#${css_id}`); //Re-get item card

    new_item_card.innerHTML = `<div class="store_card margin_fix" id="item_${item_id}">
                        <h2>${item_name}</h2>
                        <div class="bottom_card">
                        <img src="${img_loc}" height=80px><br>
                        <p class="item_descr top description">${descr}</p>
                        <h3 class="item_titles">Number in Stock</h3>
                        <p class="item_descr num_in_stock">${num_in_stock}</p>
                        <h3 class="item_titles">Price</h3>
                        <p class="item_descr unit_price">${unit_price}</p>
                        <button class="edit_item button" type="button" value=${item_id}>Edit Item</button>
                        <form method="POST" action="Includes/deleteitem_inc.php">
                        <button class="button delete" type="submit" name="delete_item" value=${item_id}>Delete Item</button>
                        </form>
                        </div>
                        </div>`; //Reverts item card back to static text
    
    new_item_card.querySelector('.edit_item').addEventListener('click', edit_item);
}

// echo '<div class="store_card" id="item_'.$row['item_id'].'">
// <h2>'.$row['name'].'</h2>
// <div class="bottom_card">
//     <img src="Uploads/Item/'.$row['img_dest'].'" height=80px>
//     <p class="item_descr top description">'.$row['description'].'</p>
//     <h3 class="item_titles">Number in Stock</h3>
//     <p class="item_descr num_in_stock">'.$row['num_in_stock'].'</p>
//     <h3 class="item_titles">Price</h3>
//     <p class="item_descr unit_price">$'.$row['unit_price'].'</p>
//     <button class="edit_item button" type="button" value='.$row['item_id'].'>Edit Item</button>
//     <form method="POST" action="Includes/deleteitem_inc.php">
//     <button class="button delete" type="submit" name="delete_item" value='.$row['item_id'].'>Delete Item</button>
//     </form>
// </div>
// </div>';