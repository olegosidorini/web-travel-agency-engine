function makeTree(){
		tree = $('.myTree');
		$('li.treeItem', tree.get(0)).each(
			function()
			{
				subbranch = $('ul', this);
				if (subbranch.size() > 0) {
					if (subbranch.eq(0).css('display') == 'none') {
						$(this).prepend('<img src="images/plus.gif"  class="expandImage" />');
					} else {
						$(this).prepend('<img src="images/minus.gif"  class="expandImage" />');
					}
				} else {
					$(this).prepend('<img src="images/spacer.gif" width="9" height="9" class="expandImage" />');
				}
			}
		);
		$('img.expandImage', tree.get(0)).click(
			function()
			{
				if (this.src.indexOf('spacer') == -1) {
					subbranch = $('ul', this.parentNode).eq(0);
					if (subbranch.css('display') == 'none') {
						subbranch.show();
						this.src = 'images/minus.gif';
					} else {
						subbranch.hide();
						this.src = 'images/plus.gif';
					}
				}
			}
		);
		$('span.textHolder').Droppable(
			{
				accept			: 'treeItem',
				hoverclass		: 'dropOver',
				activeclass		: 'fakeClass',
				tollerance		: 'pointer',
				onhover			: function(dragged)
				{
					if (!this.expanded) {
						subbranches = $('ul', this.parentNode);
						if (subbranches.size() > 0) {
							subbranch = subbranches.eq(0);
							this.expanded = true;
							if (subbranch.css('display') == 'none') {
								var targetBranch = subbranch.get(0);
								this.expanderTime = window.setTimeout(
									function()
									{
										$(targetBranch).show();
										$('img.expandImage', targetBranch.parentNode).eq(0).attr('src', 'images/minus.gif');
										$.recallDroppables();
									},
									500
								);
							}
						}
					}
				},
				onout			: function()
				{
					if (this.expanderTime){
						window.clearTimeout(this.expanderTime);
						this.expanded = false;
					}
				},
				ondrop			: function(dropped)
				{
				 new_pid = $(this).attr('id');
				 old_id = $('span.textHolder',dropped).attr('id');
					if(this.parentNode == dropped)
						return;
if (confirm('Вы дествительно хотите переместить страницу'))
{
	 movePage(old_id, new_pid);
					if (this.expanderTime){
						window.clearTimeout(this.expanderTime);
						this.expanded = false;
					}
					subbranch = $('ul', this.parentNode);
					if (subbranch.size() == 0) {
						$(this).after('<ul></ul>');
						subbranch = $('ul', this.parentNode);
					}
					oldParent = dropped.parentNode;
					subbranch.eq(0).append(dropped);
					oldBranches = $('li', oldParent);
					if (oldBranches.size() == 0) {
						$('img.expandImage', oldParent.parentNode).src('images/spacer.gif');
						$(oldParent).remove();
					}
					expander = $('img.expandImage', this.parentNode);
					if (expander.get(0).src.indexOf('spacer') > -1)
						expander.get(0).src = 'images/minus.gif';
				
}
else return;
			}
}
			
		);
		$('li.treeItem').Draggable(
			{
				revert		: true,
				autoSize		: true,
				ghosting			: true/*,
				onStop		: function()
				{
					$('span.textHolder').each(
						function()
						{
							this.expanded = false;
						}
					);
				}*/
			}
		);
		$('span.cidHolder').click(function(){
		conectContent($(this).attr('id'));
		$('span.cidHolder').css('color', '#aaaaaa');
		$(this).css('color', '#ff0000');
		});	
	
	}
//-------------------------------------------------
//----  content tree
//---------------------------------------------------

function makeContentTree(){
  $('li.folderItem').each(
			function()
			{
				subbranch = $('ul', this);
				if (subbranch.size() > 0) {
					if (subbranch.eq(0).css('display') == 'none') {
						$(this).prepend('<img src="images/plus.gif"  class="expandImage" />');
					} else {
						$(this).prepend('<img src="images/minus.gif"  class="expandImage" />');
					}
				} else {
					$(this).prepend('<img src="images/spacer.gif" width="9" height="9" class="expandImage" />');
				}
			}
		);
		$('img.expandImage').click(
			function()
			{
				if (this.src.indexOf('spacer') == -1) {
					subbranch = $('ul', this.parentNode).eq(0);
					if (subbranch.css('display') == 'none') {
						subbranch.show();
						this.src = 'images/minus.gif';
					} else {
						subbranch.hide();
						this.src = 'images/plus.gif';
					}
				}
			}
		);
		$('span.folderHolder').Droppable(
			{
				accept			: 'deskItem',
				hoverclass		: 'dropOver',
				activeclass		: 'fakeClass',
				tollerance		: 'pointer',
				onhover			: function(dragged)
				{
				 	if (!this.expanded) {
						subbranches = $('ul', this.parentNode);
						if (subbranches.size() > 0) {
							subbranch = subbranches.eq(0);
							this.expanded = true;
						}
					}
				},
				onout			: function()
				{
					if (this.expanderTime){
						window.clearTimeout(this.expanderTime);
						this.expanded = false;
					}
				},
				ondrop			: function(dropped)
				{
				new_pid = $(this).attr('id');
				old_id = $('span.textHolder',dropped).attr('id');
				type_page = $('img', dropped).attr('id');
				if (type_page == 'desk')tp_pg = 'описание';
				if (type_page == 'foto')tp_pg = 'фотографию';
					if(this.parentNode == dropped) return;
if (confirm('Вы дествительно хотите переместить ' + tp_pg))
{
				if (type_page == 'desk') moveDesk(old_id, new_pid);
				if (type_page == 'foto') moveFoto(old_id, new_pid);	
					if (this.expanderTime){
						window.clearTimeout(this.expanderTime);
						this.expanded = false;
					}
					subbranch = $('ul', this.parentNode);
					if (subbranch.size() == 0) {
						$(this).after('<ul></ul>');
						subbranch = $('ul', this.parentNode);
					}
					oldParent = dropped.parentNode;
					subbranch.eq(0).append(dropped);
					oldBranches = $('li', oldParent);
					if (oldBranches.size() == 0) {
						$(oldParent).remove();
					}
				
}
			}
}
			
		);
		$('li.deskItem').Draggable(
			{
				revert		: true,
				autoSize	: true,
				ghosting	: true
			}
		);
		

	}
	
//-------------------------------------------------
//----  media tree
//---------------------------------------------------

function makeMediaTree(){
  $('li.folderItem').each(
			function()
			{
				subbranch = $('ul', this);
				if (subbranch.size() > 0) {
					if (subbranch.eq(0).css('display') == 'none') {
						$(this).prepend('<img src="images/plus.gif"  class="expandImage" />');
					} else {
						$(this).prepend('<img src="images/minus.gif"  class="expandImage" />');
					}
				} else {
					$(this).prepend('<img src="images/spacer.gif" width="9" height="9" class="expandImage" />');
				}
			}
		);
		$('img.expandImage').click(
			function()
			{
				if (this.src.indexOf('spacer') == -1) {
					subbranch = $('ul', this.parentNode).eq(0);
					if (subbranch.css('display') == 'none') {
						subbranch.show();
						this.src = 'images/minus.gif';
					} else {
						subbranch.hide();
						this.src = 'images/plus.gif';
					}
				}
			}
		);

		

	}

