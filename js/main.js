
class Linkedselect{
	constructor($select)
	{
		this.$select = $select;
		this.onChange = this.onChange.bind(this)
		this.$select.addEventListener('change', this.onChange())

		// se declenche au changement de valeur dun select
		// prend en parametre un evenement 
		onChange(e)
		{
			//on recupere les donnees en AJAX
			let request = new XMLHttpRequest();
			request.open('GET', this.dataset.source.replace('$id', e.target.value), true)
			request.onload = () => 
			{

			}
			request.onerror = function ()
			{
				alert('Imposssible de Chager la liste')
			}
			request.send()
			// on inject les donnees dans le prochain select
		}
	}

}





let $selects = document.querySelectorAll('.linked-select')
$selects.forEach(function($select)
{
	new Linkedselect($select)
})