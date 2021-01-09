Для того чтобы Форма Комментариев работала нужно подключить:
1. в файл function.php
        /*
         * Simple ajax comment form mod                         -   ON
         * Disable comment js                                   -   ON
         * Comment form                                         -   ON
         * Reorder comment fields                               -   ON
         */
        require_once('comments/function-comments.php');
2. вывести форму комментариев в нужном месте (single.php):
        <?php if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;?>