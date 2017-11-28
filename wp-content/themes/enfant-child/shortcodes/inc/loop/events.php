<?php

$str = '<div class="ztl-event-container">';
while ($query->have_posts()) : $query->the_post();

//date
    $event_start_date = new DateTime(get_post_meta(get_the_ID(), 'enfant_event_start_date', true));

    //thumb
    $enfant_event_thumb = '';
    if (has_post_thumbnail()) {
        $enfant_event_thumb = get_the_post_thumbnail(get_the_ID(),'enfant-wide');
    }

    $enfant_event_excerpt = get_the_excerpt();

    //event duration
    $enfant_event_duration = '';
    if ($enfant_event_duration = get_post_meta(get_the_ID(), 'enfant_event_duration', true)) {
        $enfant_event_duration = '<span class="ztl-event-hour">
            <span class="flaticon-clock"></span> ' . esc_html($enfant_event_duration) . '
        </span>';
    }

    //event location
    $enfant_event_location = '';
    if ($enfant_event_location =  get_post_meta( get_the_ID(), 'enfant_event_location', true )) {
        $enfant_event_location =  '<span class="ztl-event-location">
              <span class="flaticon-signs"></span> ' . esc_html($enfant_event_location) . '
        </span>';
    }
        $str.='
        <div class="ztl-grid-12 ztl-event-item">
            <div class="row table-row">
                <div class="first ztl-col ' . enfant_get_bc('10', '10', '12', '12') . '">
                    <div class="ztl-flex">
                        <div class="ztl-post-thumbnail">
                            <a href="'.get_the_permalink().'" title="'.get_the_title().'">
                            ' . $enfant_event_thumb . '
                            </a>
                        </div>
                        <div class="ztl-post-details">
                            <div class="ztl-event-info ztl-font-bold">
                                <span class="ztl-event-date ztl-date-line">
                                    <a href="' . get_the_permalink() . '" title="' . get_the_title() .'">' . date_i18n(get_option( 'date_format' ), $event_start_date->getTimestamp()) . '</a>
                                </span>
                                ' . $enfant_event_duration .' ' . $enfant_event_location . '
                            </div>
                            <div class="ztl-event-title">
                                <h3><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>
                            </div>
                            <div class="ztl-event-description">
                                ' . $enfant_event_excerpt . '
                            </div>
                        </div>
                    </div>
                </div>

                <div class="second ztl-col ' . enfant_get_bc('2', '2', '12', '12') . '">
                    <div class="ztl-button-one">
                        <a href="'.get_the_permalink().'" title="'.get_the_title().'">'. esc_html__('Register', 'zoutula').'TEST</a>
                    </div>
                </div>
            </div>
        </div>';
    endwhile;
$str .= '</div>';