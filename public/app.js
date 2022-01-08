const setPosition = ({ top, left }) => {
    var menus = document.getElementsByClassName('menu');
    Array.prototype.forEach.call(menus, function(el){
        el.style.left = `${left}px`;
        el.style.top = `${top}px`;
    });
};

window.addEventListener("contextmenu", e => {
    const origin = {
        left: e.pageX,
        top: e.pageY
    };
    setPosition(origin);

    return false;
});

var csrf = document.querySelector('meta[name="csrf-token"]').content;

window.noteletteForm = (note_id, body, quest_id, npc_id, location_id, inventory_item_id) => {
    return {
        formData: {
            note_id: note_id,
            body: body,
            quest_id: quest_id,
            npc_id: npc_id,
            location_id: location_id,
            inventory_item_id: inventory_item_id
        },
        message: '',

        submitData() {
            this.message = ''

            fetch('/notes/' + this.formData.note_id + '/notelette', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': csrf },
                body: JSON.stringify(this.formData)
            })
            .then(() => {
                this.message = 'Your notelette has been created!',
                location.reload()
            })
            .catch(() => {
                this.message = 'Ooops! Something went wrong!'
            })
        }
    }
}
