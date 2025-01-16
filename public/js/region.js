let region_id = document.getElementById('region_id')
let region = document.getElementById('region')

console.log(current_region)
function addOption(item, index){
    let region_option = document.createElement('option')
    region_option.value = index
    region_option.text = item.name
    if(current_region == index){
        region_option.selected = true
    }
    region_id.add(region_option)
}
$(document).ready(function () {
    $.ajax({
        url:"/../api/get-regions",
        type:'GET',
        success: function (data) {
            data.data.forEach(addOption)
            region_id.addEventListener('change', function () {
                region.value = data.data[region_id.value].id
            })
        }
    });
});

edit_changed = false
