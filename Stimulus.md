Stimulus:
export *** Extend Controller class
- appel de this
	=> application = stimulus application
	=> element = HTML element
	=> identifier = nom du component

Nommage:
Identifier + _controller.(js/ts)
les underscore => -
date_picker_controller.js = date-picker

répertoire => --
users/list_item_controller.js = users--list-item

Scopes:
Un Controller ne connait que son scope.
Ni au dessus, ni celui d'autre controllers enfants

Nested controllers:
On peut mettre des controllers dans des controllers
Comme dit avant, il faut faire attention au scope du controller

Multiple COntroller:
Un element peut avoir plusieurs controllers
Plus controllers peuvent exister pour différents éléments HTML

ON UTILISE LE CAMELCASE POUR lES PROPERTIES ET METHODS dans le controller

Chargement des Controllers:
Automatique avec la config ci présente.
Sinon on peut le faire manuellement
application.register('controller', Hello_controller.js)
On peut ajouter static get shouldLoad(): bool dans le controller pour savoir s'il doit être load ou pas (En fonction des environnements etc)
method afterLoad


Communication entre Controllers:
Possible => Utilisation d'events
Méthode dispatch directement dans le controller pour plus de facilité
dispatch('event-name', {detail: any})
```
class ClipboardController extends Controller {
  static targets = [ "source" ]

  copy() {
    this.dispatch("copy", { detail: { content: this.sourceTarget.value } })
    navigator.clipboard.writeText(this.sourceTarget.value)
  }
}
```
Les events peuvent être appelé directement dans les actions (Voir plus loin)
```
class EffectsController extends Controller {
  flash({ detail: { content } }) {
    console.log(content) // 1234
  }
}

<div data-controller="clipboard effects" data-action="clipboard:copy->effects#flash">
  PIN: <input data-clipboard-target="source" type="text" value="1234" readonly>
  <button data-action="clipboard#copy">Copy to Clipboard</button>
</div>
```

On peut stopped la propagation des events et autre voir la doc.


On peut (Vraiment si nécessaire, non recommandé) accédé à une instance de controller avec la méthode this.application.getControllerForElementAndIdentifier(HTMLElement, Identifier)



Life CycleCallBacks:
connect()
'name'TargetConnected(element)
disconnect()
'name'TargetDisconnected(element)


MutationObserver


Actions:
on appelle une action depuis le DOM
Cette action est une méthode du Controller
```
<div data-controller="gallery">
  <button data-action="click->gallery#next">…</button>
</div>

export default class extends Controller {
  next(event) {
    // …
  }
}
```

click->gallery#next = Action descriptor
click = nom de l'event DOM
gallery l'identifier du controller (On peut toujours avoir plusieurs controller)
next = nom de la méthode

Il y a des raccourcis 
=> On peut enlever le 'click' dans l'exemple ci dessus car c'est sur un bouton
Liste des raccourcis: https://stimulus.hotwired.dev/reference/actions#event-shorthand

Prise en charge des KeyboardEvent: https://stimulus.hotwired.dev/reference/actions#keyboardevent-filter
```
<div data-controller="modal"
     data-action="keydown.esc->modal#close" tabindex="0">
</div>
```
On peut changer le keyMapping => Exemple ajouter at pour '@'


Global Events:
On peut déclencer des actions sur des événements globaux du dom ou de la window
Exemple:
```
<div data-controller="gallery"
     data-action="resize@window->gallery#layout">
</div>
```
On peut ajouter des options sur les actions 
```
<div data-controller="gallery"
     data-action="resize@window->gallery#layout:once">
</div>
```
On peut créer ses propres options pour les actions
Voir plus: https://stimulus.hotwired.dev/reference/actions#options

On peut avoir plusieurs actions => séparées pour " "
Elles sont lues et exécutées de gauche à droite


La méthode liée à l'event recoit deux paramètres:
- l'objet DOM qui l'a déclenché
- L'objet Event Js qui a été appelé

On peut ajouter des paramètre à l'Event Js avec l'attribut:
data-[identifier-controller]-[param-name]-param
Ils doivent être sûr l'élément qui déclenche l'action
Leur type est typecaste automatique en Number, String, Object ou Boolean

Exemple:
```
<div data-controller="item spinner">
  <button data-action="item#upvote spinner#start" 
    data-item-id-param="12345" 
    data-item-url-param="/votes"
    data-item-payload-param='{"value":"1234567"}' 
    data-item-active-param="true">…</button>
</div>

// ItemController
upvote(event) {
  // { id: 12345, url: "/votes", active: true, payload: { value: 1234567 } }
  console.log(event.params) 
}

// SpinnerController
start(event) {
  // {}
  console.log(event.params) 
}
```
https://stimulus.hotwired.dev/reference/actions#action-parameters



Targets:
On peut identifier des éléments dans notre Component avec l'attribut:
data-[identifier-controller]-target="Nom de la target"
On peut mettre plusieurs noms à la target et y faire référence dans le Controller

Les targets sont définies dans le Controller avec la propriété static targets qui est un tableau
```
// controllers/search_controller.js
import { Controller } from "@hotwired/stimulus"

export default class extends Controller {
  static targets = [ "query", "errorMessage", "results" ]
  // …
}
```

Dans le Controller on peut accéder aux targets à l'aide de:
this.[name]Target
this.[name]Targets
this.has[Name]Target //Optionnal target

Rappel LifeCycleCallBacks:
[name]TargetConnected
[name]TargetDisconnected


Outlets:
Autre moyen de récupérer d'autre Controllers
data-[identifier-controller]-[outlet]-outlet="[selector]"
[outlet] = identifier des autres controllers
[selector] selecteur css

Même principe que les targets mais avec des Controllers:
```
<div>
  <div class="online-user" data-controller="user-status">...</div>
  <div class="online-user" data-controller="user-status">...</div>
  ...
</div>

...

<div data-controller="chat" data-chat-user-status-outlet=".online-user">
  ...
</div>
```
Pas forcément des Controllers nested => Partout sur la page

On définie les outlets avec la propriété static outlets dans le Controller = pareil que les targets
```
// chat_controller.js

export default class extends Controller {
  static outlets = [ "user-status" ]

  connect () {
    this.userStatusOutlets.forEach(status => ...)
  }
}
```
On peut accéder aux outlets dans le Controller via les méthodes:
has[Name]Outlet
[name]Outlet //Controller
[name]Outlets //Controllers
[name]OutletElement //Controller Element
[name]OutletElements //Controllers Element


On peut accéder à tout ce qui est définit par l'outlet
Méthodes, propriétés, classes, targets et même l'Element de l'outlet

LifeCycleCallBacks
[name]OutletConnected() 
[name]OutletDisconnected()



Values:

Css Classes








