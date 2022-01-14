const setPosition = ({ top, left }) => {
    var menus = document.getElementsByClassName('menu');
    Array.prototype.forEach.call(menus, function(el){
        el.style.left = `${left}px`;
        el.style.top = `${top}px`;
    });
};

window.addEventListener("contextmenu", e => {
    if (window.innerWidth > 640) {
        const origin = {
            left: e.pageX,
            top: e.pageY
        };
        setPosition(origin);
    }else{
        const origin = {
            left: e.pageX,
            top: 14
        };
        setPosition(origin);
    }

    return false;
});

var csrf = document.querySelector('meta[name="csrf-token"]').content;

window.noteForm = (note_id) => {

    return {
        formData: {
            note_id: note_id,
        },
        message: '',

        submitData() {
            title = document.getElementById('notetitle' + this.formData.note_id).innerText
            body = document.getElementById('notebody' + this.formData.note_id).innerText
            this.formData.title = title
            this.formData.body = body
            this.message = ''

            fetch('/notes/' + this.formData.note_id + '/update', {
                method: 'PATCH',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': csrf },
                body: JSON.stringify(this.formData)
            })
            .then(() => {
                this.message = 'Your note is saved!',
                location.reload()
            })
            .catch(() => {
                this.message = 'Oops! Something went wrong!'
            })
        }
    }
}

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

            if (body === null){
                this.open = false;
                this.message = 'Please select a portion of the note to create a notelette.';
                setTimeout(() => {this.message = ''}, 3000);
            }else{
                this.open = false;
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
}
navigator.serviceWorker.register('sw.js', {
    scope: './'
});
