import {Controller} from "@hotwired/stimulus";

export default class LoaderController extends Controller {
    static values = {
        url: String,
    }

    declare urlValue: string;

    connect() {
        fetch(this.urlValue)
            .then((r) => {
                if (r.status === 200) {
                    return r.text();
                }
            }).then((e) => {
                if (e !== undefined) {
                    this.element.innerHTML = e;
                }
        })
            .catch((e) => {
                console.log(e)
            })
    }
}