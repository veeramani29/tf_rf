$(function() {
    // crud table
    altair_crud_table.init();
});

altair_crud_table = {
    init: function() {

        $('#students_crud').jtable({
            title: 'The Admin List',
            paging: true, //Enable paging
            pageSize: 10, //Set page size (default: 10)
            addRecordButton: $('#recordAdd'),
            deleteConfirmation: function(data) {
                data.deleteConfirmMessage = 'Are you sure to delete this ' + data.record.username + '?';
            },
            formCreated: function(event, data) {
                // replace click event on some clickable elements
                // to make icheck label works
                data.form.find('.jtable-option-text-clickable').each(function() {
                    var $thisTarget = $(this).prev().attr('id');
                    $(this)
                        .attr('data-click-target',$thisTarget)
                        .off('click')
                        .on('click',function(e) {
                            e.preventDefault();
                            $('#'+$(this).attr('data-click-target')).iCheck('toggle');
                        })
                });
                // create selectize
                data.form.find('select').each(function() {
                    var $this = $(this);
                    $this.after('<div class="selectize_fix"></div>')
                    .selectize({
                        dropdownParent: 'body',
                        placeholder: 'Click here to select ...',
                        onDropdownOpen: function($dropdown) {
                            $dropdown
                                .hide()
                                .velocity('slideDown', {
                                    begin: function() {
                                        $dropdown.css({'margin-top':'0'})
                                    },
                                    duration: 200,
                                    easing: easing_swiftOut
                                })
                        },
                        onDropdownClose: function($dropdown) {
                            $dropdown
                                .show()
                                .velocity('slideUp', {
                                    complete: function() {
                                        $dropdown.css({'margin-top':''})
                                    },
                                    duration: 200,
                                    easing: easing_swiftOut
                                })
                        }
                    });
                });
                // create icheck
                data.form
                    .find('input[type="checkbox"],input[type="radio"]')
                    .each(function() {
                        var $this = $(this);
                        $this.iCheck({
                            checkboxClass: 'icheckbox_md',
                            radioClass: 'iradio_md',
                            increaseArea: '20%'
                        })
                        .on('ifChecked', function(event){
                            $this.parent('div.icheckbox_md').next('span').text('Active');
                        })
                        .on('ifUnchecked', function(event){
                            $this.parent('div.icheckbox_md').next('span').text('Inactive');
                        })
                    });
                // reinitialize inputs
                data.form.find('.jtable-input').children('input[type="text"],input[type="password"],textarea').not('.md-input').each(function() {
                    $(this).addClass('md-input');
                    altair_forms.textarea_autosize();
                });
                altair_md.inputs();
            },
            actions: {
                listAction: WEB_URL+'admin/test?action=list',
                createAction: WEB_URL+'admin/test?action=create',
                updateAction: WEB_URL+'admin/test?action=update',
                deleteAction: WEB_URL+'admin/test?action=delete',
            },
            fields: {
                user_id: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false
                },
                username: {
                    title: 'Name',
                     type: 'text',
                    width: '23%'
                },
                user_email: {
                    title: 'Email address',
                     type: 'text',
                    width: '23%'
                },
                 password: {
                    title: 'User Password',
                    type: 'password',
                    list: false,
                    edit: false,
                },
                phone_number: {
                    title: 'Phone Number',
                    type: 'text',
                     width: '23%'
                },
                 address: {
                    title: 'Address',
                    type: 'textarea',
                   
                },
                access_level: {
                    title: 'Access Level',
                    width: '13%',
                    options: {'ACC-1': 'Admin', 'ACC-2': 'Sub-admin','ACC-3': 'Marketing'}
                },
                
               
                user_status: {
                    title: 'Status',
                    width: '12%',
                    type: 'checkbox',
                    values: { 'Inactive': 'Inactive', 'Active': 'Active' },
                    defaultValue: 'Active'
                }
            }
        }).jtable('load');

        // change buttons visual style in ui-dialog
        $('.ui-dialog-buttonset')
            .children('button')
            .attr('class','')
            .addClass('md-btn md-btn-flat')
            .off('mouseenter focus');
        $('#AddRecordDialogSaveButton,#EditDialogSaveButton,#DeleteDialogButton').addClass('md-btn-flat-primary');

    }
};