import { Controller } from '@hotwired/stimulus';
import {Application} from "@hotwired/stimulus/dist/types/core/application";

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {
        console.log(this);
        console.log(this.application);
        console.log(this.identifier);
    }

    static get shouldLoad()
    {
        return true;
    }

    static afterLoad(_identifier: string, _application: Application) {
        console.log('AFTER LOADED')
    }
}
