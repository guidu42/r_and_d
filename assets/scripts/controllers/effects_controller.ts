import {Controller} from "@hotwired/stimulus";

export default class EffectsController extends Controller {
    flash(e: { detail: { content: string } }) {
        console.log(e.detail.content) // 1234
    }
}