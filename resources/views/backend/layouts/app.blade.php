<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Styles -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
        <link href="{{asset('build/plugins/select2/select2.min.css')}}" rel="stylesheet">
        <link href="{{asset('build/plugins/fileupload/jquery.fileuploader.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/jquery-ui.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
        <link href="{{asset('assets/css/bootstrap2-toggle.min.css')}}" rel="stylesheet">
        @yield('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(getRtlCss(mix('css/backend.css'))) }}
        @else
            {{ Html::style(mix('css/backend.css')) }}
        @endif

        @yield('after-styles')

        @yield('head_js')

        <script src="{{asset('/assets/js/WKL.js')}}"></script>

    </head>

    <body class="skin-{{ config('backend.theme') }} {{ config('backend.layout') }}">
        @include('includes.partials.logged-in-as')

        <div class="wrapper">
            @include('backend.includes.header')
            @include('backend.includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')

                    {{-- Change to Breadcrumbs::render() if you want it to error to remind you to create the breadcrumbs for the given route --}}
                    {!! Breadcrumbs::renderIfExists() !!}
                </section>

                <!-- Main content -->
                <section class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <!-- JavaScripts -->
        <script src="{{asset('assets/js/cldr.js')}}"></script>
        <script src="{{asset('assets/js/event.js')}}"></script>
        <script src="{{asset('assets/js/supplemental.js')}}"></script>
        <script src="{{asset('assets/js/globalize.js')}}"></script>
        <script src="{{asset('assets/js/globalize/message.js')}}"></script>
        <script src="{{asset('assets/js/globalize/number.js')}}"></script>
        <script src="{{asset('assets/js/globalize/plural.js')}}"></script>
        <script src="{{asset('assets/js/globalize/date.js')}}"></script>
        <script src="{{asset('assets/js/globalize/currency.js')}}"></script>
        {{ Html::script(mix('js/backend.js')) }}
        <script src="{{asset('/assets/js/summernote.min.js')}}"></script>
        <script src="{{asset('assets/js/moment.min.js')}}"></script>
        <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        {{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
        <![endif]-->

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

        <script src="{{asset('/assets/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap2-toggle.min.js')}}"></script>

        @yield('before-scripts')

        <script src="{{asset('build/plugins/select2/select2.min.js')}}"></script>
        <script src="{{asset('build/plugins/fileupload/jquery.fileuploader.min.js')}}"></script>
        <script type="text/javascript">
            Globalize.load({
                "main": {
                    "en": {
                        "identity": {
                            "version": {
                                "_cldrVersion": "25",
                                "_number": "$Revision: 91 $"
                            },
                            "generation": {
                                "_date": "$Date: 2014-03-13 22:27:12 -0500 (Thu, 13 Mar 2014) $"
                            },
                            "language": "en"
                        },
                        "dates": {
                            "calendars": {
                                "gregorian": {
                                    "days": {
                                        "format": {
                                            "wide": {
                                                "sun": "Sunday",
                                                "mon": "Monday",
                                                "tue": "Tuesday",
                                                "wed": "Wednesday",
                                                "thu": "Thursday",
                                                "fri": "Friday",
                                                "sat": "Saturday"
                                            }
                                        }
                                    },
                                    "months": {
                                        "format": {
                                            "abbreviated": {
                                                "1": "Jan",
                                                "2": "Feb",
                                                "3": "Mar",
                                                "4": "Apr",
                                                "5": "May",
                                                "6": "Jun",
                                                "7": "Jul",
                                                "8": "Aug",
                                                "9": "Sep",
                                                "10": "Oct",
                                                "11": "Nov",
                                                "12": "Dec"
                                            },
                                            "wide": {
                                                "1": "January",
                                                "2": "February",
                                                "3": "March",
                                                "4": "April",
                                                "5": "May",
                                                "6": "June",
                                                "7": "July",
                                                "8": "August",
                                                "9": "September",
                                                "10": "October",
                                                "11": "November",
                                                "12": "December"
                                            }
                                        }
                                    },
                                    "dayPeriods": {
                                        "format": {
                                            "wide": {
                                                "am": "AM",
                                                "am-alt-variant": "am",
                                                "noon": "noon",
                                                "pm": "PM",
                                                "pm-alt-variant": "pm"
                                            }
                                        }
                                    },
                                    "dateFormats": {
                                        "full": "EEEE, MMMM d, y",
                                        "medium": "MMM d, y"
                                    },
                                    "timeFormats": {
                                        "full": "h:mm:ss a zzzz",
                                        "medium": "h:mm:ss a",
                                    },
                                    "dateTimeFormats": {
                                        "full": "{1} 'at' {0}",
                                        "medium": "{1}, {0}"
                                    }
                                }
                            },
                            "fields": {
                                "second": {
                                    "displayName": "Second",
                                    "relative-type-0": "now",
                                    "relativeTime-type-future": {
                                        "relativeTimePattern-count-one": "in {0} second",
                                        "relativeTimePattern-count-other": "in {0} seconds"
                                    },
                                    "relativeTime-type-past": {
                                        "relativeTimePattern-count-one": "{0} second ago",
                                        "relativeTimePattern-count-other": "{0} seconds ago"
                                    }
                                }
                            },
                            "timeZoneNames": {
                                "metazone": {
                                    "Brasilia": {
                                        "long": {
                                            "generic": "Brasilia Time",
                                            "standard": "Brasilia Standard Time",
                                            "daylight": "Brasilia Summer Time"
                                        }
                                    }
                                }
                            }
                        },
                        "numbers": {
                            "currencies": {
                                "USD": {
                                    "symbol": "$"
                                }
                            },
                            "defaultNumberingSystem": "latn",
                            "symbols-numberSystem-latn": {
                                "decimal": ".",
                                "exponential": "E",
                                "group": ",",
                                "infinity": "∞",
                                "minusSign": "-",
                                "nan": "NaN",
                                "percentSign": "%",
                                "perMille": "‰",
                                "plusSign": "+",
                                "timeSeparator": ":"
                            },
                            "decimalFormats-numberSystem-latn": {
                                "standard": "#,##0.###"
                            },
                            "currencyFormats-numberSystem-latn": {
                                "currencySpacing": {
                                    "beforeCurrency": {
                                        "currencyMatch": "[:^S:]",
                                        "surroundingMatch": "[:digit:]",
                                        "insertBetween": " "
                                    },
                                    "afterCurrency": {
                                        "currencyMatch": "[:^S:]",
                                        "surroundingMatch": "[:digit:]",
                                        "insertBetween": " "
                                    }
                                },
                                "standard": "¤#,##0.00"
                            }
                        },
                        "units": {
                            "short": {
                                "per": {
                                    "compoundUnitPattern": "{0}/{1}"
                                },
                                "speed-mile-per-hour": {
                                    "displayName": "miles/hour",
                                    "unitPattern-count-one": "{0} mph",
                                    "unitPattern-count-other": "{0} mph"
                                }
                            }
                        }
                    }
                },
                "supplemental": {
                    "version": {
                        "_cldrVersion": "25",
                        "_number": "$Revision: 91 $"
                    },
                    "currencyData": {
                        "fractions": {
                            "DEFAULT": {
                                "_rounding": "0",
                                "_digits": "2"
                            }
                        }
                    },
                    "likelySubtags": {
                        "en": "en-Latn-US",
                    },
                    "metaZones": {
                        "metazoneInfo": {
                            "timezone": {
                                "America": {
                                    "Sao_Paulo": [
                                        {
                                            "usesMetazone": {
                                                "_mzone": "Brasilia"
                                            }
                                        }
                                    ]
                                }
                            }
                        }
                    },
                    "plurals-type-cardinal": {
                        "en": {
                            "pluralRule-count-one": "i = 1 and v = 0 @integer 1",
                            "pluralRule-count-other": " @integer 0, 2~16, 100, 1000, 10000, 100000, 1000000, … @decimal 0.0~1.5, 10.0, 100.0, 1000.0, 10000.0, 100000.0, 1000000.0, …"
                        }
                    }
                }
            });
            jQuery('select').select2();
            var fileUpload = jQuery('#fileupload').fileuploader({
                dataType: 'json',
                enableApi: true,
                addMore: true,
                thumbnails: {
                    item2:  '<li class="fileuploader-item" data-image-id="${data.id}">' +
                            '<div class="columns">' +
                            '<a href="${data.url}" target="_blank">' +
                            '<div class="column-thumbnail">${image}<span class="fileuploader-action-popup"></span></div>' +
                            '<div class="column-title">' +
                            '<div title="${name}">${name}</div>' +
                            '<span>${size2}</span>' +
                            '</div>' +
                            '</a>' +
                            '<div class="column-actions">' +
                            '<a href="${file}" class="fileuploader-action fileuploader-action-download" title="${captions.download}" download><i></i></a>' +
                            '<a class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i></i></a>' +
                            '</div>' +
                            '</div>' +
                            '</li>',

                    onItemRemove: function(itemEl, listEl, parentEl, newInputEl, inputEl) {
                        var context = this,
                            itemId  = itemEl[0].dataset.imageId;

                        WKL.runRequest('{{route('admin.gallery.ajax-remove-images')}}', 'POST', {imageId: itemId}, false);

                        itemEl.children().animate({'opacity': 0}, 200, function() {
                            setTimeout(function() {
                                itemEl.slideUp(200, function() {
                                    itemEl.remove();
                                });
                            }, 100);
                        });
                    }
                },

                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo(document.body);
                    });
                }
            });
        </script>
        @yield('after-scripts')

    </body>
</html>