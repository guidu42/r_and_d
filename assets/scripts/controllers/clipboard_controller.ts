import {Controller} from "@hotwired/stimulus";

export default class ClipboardController extends Controller
{
    static targets = [ "source" ]

    declare sourceTarget: HTMLInputElement;
    copy() {
        this.dispatch("copy", { detail: { content: this.sourceTarget.value } })
        navigator.clipboard.writeText(this.sourceTarget.value)
    }
}