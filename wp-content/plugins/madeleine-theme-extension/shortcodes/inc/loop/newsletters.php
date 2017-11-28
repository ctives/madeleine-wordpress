<?php

$str = '<div class="ztl-newsletter-container">';
while ($query->have_posts()) : $query->the_post();

     //date
    $newsletter_start_date = new DateTime(get_post_meta(get_the_ID(), 'madeleine_newsletter_start_date', true));

        $str.='
        <div class="ztl-grid-12 ztl-newsletter-item">
            <div class="row table-row">
                <div class="first ztl-col ' . madeleine_get_bc('10', '10', '12', '12') . '">
                    <div class="ztl-flex">
                        <div class="ztl-post-details">
                            <div class="ztl-newsletter-info ztl-font-bold">
                                <span class="ztl-newsletter-date ztl-date-line">
                                    <a href="' . get_the_permalink() . '" title="' . get_the_title() .'">' . date_i18n(get_option( 'date_format' ), $newsletter_start_date->getTimestamp()) . '</a>
                                </span>
                            </div>
                            <div class="ztl-newsletter-title">
                                <h3><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="second ztl-col ' . madeleine_get_bc('2', '2', '12', '12') . '">
                    <div class="ztl-button-one">
                        <a href="'.get_the_permalink().'" title="'.get_the_title().'">'. esc_html__('Details', 'zoutula').'</a>
                    </div>
                </div>
            </div>
        </div>';
    endwhile;
$str .= '</div>';