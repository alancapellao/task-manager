var locale = $('html').attr('lang') || 'en';

const languageTexts = {
        'en': {
                'success': 'Success',
                'error': 'Error',
                'info': 'Info',
                'warning': 'Warning',
                'btnYes': 'Yes',
                'btnNo': 'No',
                'btnOk': 'OK',
                'list': {
                        'title': 'Delete List',
                        'message': 'Are you sure you want to delete this list?',
                },
                'note': {
                        'title': 'Delete Note',
                        'message': 'Are you sure you want to delete this note?',
                },
                'tag': {
                        'title': 'Delete Tag',
                        'message': 'Are you sure you want to delete this tag?',
                        'no-tag': 'No tags found.',
                },
                'task': {
                        'title': 'Delete Task',
                        'message': 'Are you sure you want to delete this task?',
                },
        },
        'pt-BR': {
                'success': 'Sucesso',
                'error': 'Erro',
                'info': 'Informação',
                'warning': 'Atenção',
                'btnYes': 'Sim',
                'btnNo': 'Não',
                'btnOk': 'OK',
                'list': {
                        'title': 'Excluir Lista',
                        'message': 'Tem certeza que deseja excluir esta lista?',
                },
                'note': {
                        'title': 'Excluir Nota',
                        'message': 'Tem certeza que deseja excluir esta nota?',
                },
                'tag': {
                        'title': 'Excluir Tag',
                        'message': 'Tem certeza que deseja excluir esta tag?',
                        'no-tag': 'Nenhuma tag encontrada.',
                },
                'task': {
                        'title': 'Excluir Tarefa',
                        'message': 'Tem certeza que deseja excluir esta tarefa?',
                },
        },
};

$('html').on('change', function () {
        locale = $(this).attr('lang');
});