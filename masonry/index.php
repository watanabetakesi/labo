<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>
<style>
#grid {
  display: grid;
  grid-template-rows: 10px;
  grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
}

.item {
  width: 200px;
  margin-left: 10px;
  margin-top: 10px;
  background: #c9c9c9;
  color: white;

  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
<script>
let index = 1;
const addItem = () => {
  const height = randomNum();
  const grid = document.querySelector('#grid');
  const item = document.createElement('div');
  item.setAttribute('class', 'item');
  item.setAttribute('style', `height: ${height}px;grid-row: span ${Math.ceil(height / 10)};`);
  item.innerHTML = index;
  index += 1;
  grid.appendChild(item);
}

const randomNum = () => {
  const min = 40;
  const max = 200;
  return Math.floor(Math.random() * (max - min + 1) + min)
}

window.addEventListener('load', () => {
  for (let i = 0; i < 10; i++) {
    addItem();
  }
  document.querySelector('#addItemButton').addEventListener('click', () => {
    addItem();
  })
})
</script>
<div class="wrapper">
    <button id="addItemButton">
    addItem
    </button>
    <div id="grid">
    </div>
</div>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>


