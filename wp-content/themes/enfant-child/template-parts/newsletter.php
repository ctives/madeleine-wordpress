<?php
/**
 * Madeleine event template part
 *
 * @package enfant-child
 */

$newsletter_start_date = new DateTime(get_post_meta(get_the_ID(), 'madeleine_newsletter_start_date', true));
?>
<div class="ztl-grid-12 ztl-event-item">
    <div class="row table-row">
        <div class="first ztl-col <?php enfant_bc('10', '10', '12', '12')?>">
            <div class="ztl-flex">
                <div class="ztl-post-details">
                    <div class="ztl-event-info ztl-font-bold">
                        <span class="ztl-event-date ztl-date-line">
                            <a href="<?php get_the_permalink(); ?>" title="<?php the_title(); ?>"><?php  echo date_i18n(get_option( 'date_format' ), $newsletter_start_date->getTimestamp()); ?></a>
                        </span>
                    </div>
                    <div class="ztl-event-title">
                        <h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?> </a></h3>
                    </div>
                    <div class="ztl-event-description">
                        <?php enfant_excerpt( 40, false ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
