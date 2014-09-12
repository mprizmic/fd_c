/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('.btn-add').click(function(event) {
        var collectionHolder = $('#' + $(this).attr('data-target'));
        var prototype = collectionHolder.attr('data-prototype');
        var form = prototype.replace(/__name__/g, collectionHolder.children().length);

        collectionHolder.append(form);

        return false;
    });
    $('.btn-remove').live('click', function(event) {
        var name = $(this).attr('data-related');
        $('*[data-content="' + name + '"]').remove();

        return false;
    });
})
        ;

