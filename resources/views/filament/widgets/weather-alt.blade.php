<div class="weather-alt-wrapper">
    <div class="weather-alt">
        <main>
            <header>
                <div>
                    <div class="font-bold text-lg">{{ $this->getWeatherData()->date('F Y') }}</div>
                    <div class="text-slate-400 text-xs">{{ $this->getWeatherData()->date('l, j') }}</div>
                </div>
                <div>
                    <span class="time">
                        {{ date('H:i') }}
                    </span>
                </div>
            </header>

            <div class="grid grid-cols-2 gap-10 border-y border-y-white pb-10 drop-shadow-sm  p-4 bg-white/70">
                <div class="overview">
                    <div class="icon">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAADV0lEQVR4nNWVSUwTURzGR71poldjoje9e9GYmCgHDwZBiW0iEY1Gg4AebACLlDJjW5Sl0sVOoUAZ6AYWISymICVS4wJqQYtiCrIVtUMLVkUCEUn+5tW0ThdAawH9ki+Z9/LN98ubNzMPw/4FcfNVW3jF1EkBqcvLlVEXufmqHcGZXGkVjjIo+zc9fuFyzZkbqlpns8U69+jlW2jv6lsormqYEJA6JY7j6305kdLgqW/vnssrraEJhe5UpD1e4RLNMVLfMjXi+gSOyekA15mfzAhu6ZQ/kxhWUF5Ho/kh2gNybdNHfrEmLlzPMO2Bp/2jYH83GbbHKxGpHx1yekKgyGPuLyCuqHfzxJXbmWBk+zs3CEndaHBP16th4IhUkHxVAqk5cmjutIb0YFnisl0qY+tEOKjP97ps3/k3q9OCwcilt1snMgsqdzJ7cKnGC/UZwdHKmT1YVmHFPsPdB1PMMqJQAWfTrvideP4yxMQmOvYciLOIFNpvzCzVYJ4/zDrXi4yu0dwlXBEARkaP/aFtEIQK/XUvOLOgYptc2xSwimA3dT6f5YnVieFWLNM00RmF1FZmz011QwA0PU8FwxOegB6vhEp9j23YGRaK9kxUonfhMu3mYHDPgANESr01uOeNw+WFo5UTMh10vx4N6fHv8/WSGrrHPh4ARS+PVNPowaVVSb6sD9w74IC8khoa7W8kPRjzJiGp65FrG2ldi+WjythGi0jDCF9Oxf5KYViurHq6mGpw4zLNNBP6pz0hQvuFXrhwpUhcsXo/yiRnSSx/0xOxlgP/oWBdfI6JxbpmzmcLzAVLOSnXOL5cBjmBb0o7lH5v05JYNtFenaJ88ZVXMwbRcnqlfZ5NmPvYbOOGRcEnhPffF7V+hmj7vOzZZDzXtHtxsMhCrwQ4TWn7dJTXcvC3wMSdD3BB8hhSpJGZqxmMDJxT6wCqbQB8MnQMwquRKf+4n8MBprLLu/zXKJehfv2fg12eWZiZm/ePZ4aGYGFhAcbG33vHI84vKwMOJ2tvH5RRhpD5FQdLSTWcTuasPpiVlAJ7Y+LB5Z6MHphYq8+paFV/IMI1+mWyrnVUpZK90T0kKPs8izDbljwkvMditinhOGG+xcbNpdHwMZ4p9QjevHEJ6OrqBx4VLd9rVtWmAAAAAElFTkSuQmCC">
                    </div>
                    <div class="col-span-2 flex flex-col">
                        <div class="caption">Wind Speed</div>
                        <div class="value">
                            {{ $this->getWeatherData()?->current('windSpeed') }}
                            <small>m/s</small>

                            @php($windDiff = $this->getWeatherData()?->windDiffWithPrev())
                            <div class="-mt-1">
                                @if($windDiff && $windDiff > 0)
                                <div class="flex items-center text-xs text-red-500">
                                    +{{ $windDiff }} m/s
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </div>
                                @elseif($windDiff && $windDiff < 0)
                                    <div
                                    class="flex items-center text-xs text-green-800">
                                    {{ $windDiff }} m/s
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overview">
                    <div class="icon">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADcUlEQVR4nO2YW2sTQRTHT8ULeKO2mszGV30RxGJ3pfUbiMVLFf0QFbUV3I0WixdQfLJekMz4olUEv4IP7gaUPthWulstVSQzSREr0pm0aAu1KxsvbSZJczFNN5gfnIfdDeT/nznnzHAAatSoUeMPLa94g2byi5rJ+1VTfNUsMa1aYkg1xdWmaHIb+Jl9ljiomkJolnCzhfdNtSaPgR/RzORR1eJzucT/DZPP+85E68upgGbyibziF+2Er9JJNcUZaZVnm6OiU3suGve8mKzXTHFas/iMZOIK+AXVnGxPE2fxjnwmvcIG3+C6darFw6rFo5rFu73nrN0pfQeSUE20ZBoQUE2oljgrFfMgVMvKq554k89KBi5XTIQWFW2ayccLbZMFBG9+kdxaMQOqxRNlE2/yH96hVzHxZTbAKy6+DCk0pZliwDu4Kpo2NWr8zwRxrA1hNq4Q5q5YYDqNMB1FmD4JYnpi1zNnbcEGEKGJFRVPssYHROLt1WzA/RX0JvS4q/yfQiSPCb8TfPRpQwDHWxChtxFms5k1wip/opdKCCea5LRGmL4vqrB9YQKn7wTCseNQTSBM76QZIPTxwlfDbgPDHgfDcUuIadDtIdCdaxAeXLZxSQDHW9INsHcLX3UnUaL49NBtAbq9LIOrxgdfNqUXMk2W30Aq7PnlMNHQN7ZZ6kSiXCmUfSdypFPoYaIxiFlHqhW6mSOYXIQeJFqlTjRanqXpGaoHY/g0GPaMZCJz+tbjrlYwG1mUx5cK/RuF0LtSCvVBWdHtM5KBjOnb9vvxnVIhzgQibHde8ZHY3uVvo8bwFqkWMqZv3uGDCKVSO4wvZUIhtFm+2iBCxyDyek0R6tw6MJww6HYUdLs79SzT6TTkM+DhrZx8NUCYfUeE3QoStk+JjK/fdvfzxlAktl8h9F7GVQLT+VCEHipCPACE7XapUE9l/EZ3OiUDOadvCLPeUi9zCLPrxYnPnt+zYDhdYLxt/JU69tnf7xYbyD19c926Ukwgwm7kvU5n5dybAOjORBGtlBdyKqNI/JiCWSy/cDqmYHoY/onwyBEwnLkCzoAfoA8XfN3d0Tu2LkToSUToU4Wwj4jQbwqhUwpmb71Wmeo2xRXsEpwfOZA6pJZa+SLErwxet9HtC6Db/WDYX1PdRrcHUjnfNVqbvtWAKuMn4cJk6muVN9gAAAAASUVORK5CYII=">
                    </div>
                    <div class="col-span-2 flex flex-col">
                        <div class="caption">Wind Direction</div>
                        <div class="value">
                            {{ $this->getWeatherData()?->current('windDirection') }}
                            <small>º</small>

                            @php($windDiff = $this->getWeatherData()?->windDirectionDiffWithPrev())
                            <div class="-mt-1">
                                @if($windDiff && $windDiff > 0)
                                <div class="flex items-center text-xs">
                                    +{{ $windDiff }} º
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </div>
                                @elseif($windDiff && $windDiff < 0)
                                    <div
                                    class="flex items-center text-xs ">
                                    {{ $windDiff }} º
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overview">
                    <div class="icon">
                        <img src="data:image/png;base64,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">
                    </div>
                    <div class="col-span-2 flex flex-col">
                        <div class="caption">Water Temperature</div>
                        <div class="value">
                            {{ $this->getWeatherData()?->current('waterTemperature') }}
                            <small>m/s</small>

                            @php($windDiff = $this->getWeatherData()?->waterTemperatureDiffWithPrev())
                            <div class="-mt-1">
                                @if($windDiff && $windDiff > 0)
                                <div class="flex items-center text-xs text-red-500">
                                    +{{ $windDiff }} m/s
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </div>
                                @elseif($windDiff && $windDiff < 0)
                                    <div
                                    class="flex items-center text-xs text-green-800">
                                    {{ $windDiff }} m/s
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overview">
                    <div class="icon">
                        <img src="data:image/png;base64,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">
                    </div>
                    <div class="col-span-2 flex flex-col">
                        <div class="caption">Visibility</div>
                        <div class="value">
                            {{ $this->getWeatherData()?->current('visibility') }}
                            <small>m</small>

                            @php($windDiff = $this->getWeatherData()?->visibilityDiffWithPrev())
                            <div class="-mt-1">
                                @if($windDiff && $windDiff > 0)
                                <div class="flex items-center text-xs text-red-500">
                                    +{{ $windDiff }} m
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </div>
                                @elseif($windDiff && $windDiff < 0)
                                    <div
                                    class="flex items-center text-xs text-green-800">
                                    {{ $windDiff }} m
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overview">
                    <div class="icon">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAErElEQVR4nO2aXYhVVRTHfzbmnTCae2e06UvKxzDKh56Mmog+nHLKfLPsTbGXbJrMIKh8Cfp6CgSfksr3wJhEH6pJrJksK5Emy0jMlHIIoppGLG4s+h9YnfY599xz93Gm8A8H7r1777X22mvvtdf6nwvn8f9FL7AaeAkYBb4EfgLO6LHPk2qzPvcBDeYIuoGHgL3An0CzzecPYA+wDqjNhgEXAY8DJ92kZoB3gKflmWu14hfqaeg3a3sGeFdjkvHfAyNanHOCe4Bv3AQOAOuBnhKy6sAG4GMn7ygwSIWwldruFH4C3BlR/krgUyd/WxXeuUwTNwW/AY8AXbGV8LfMR4Fp5+3+WMKXyt1NRZ3r2hy/H9jX5pjrgSPS+bXm0LEnEiM+UIgNYT6wExgOtJkR7wd+fwx4A7ggQ2YfMO6MKe2ZbredzIiFOX0b2g62+kXxIfBLC7kLnTEHyp6Z7W47ZXnC4ypFoaKwvlcW6NfntpkFgLZDbHKwQ2fi5opu5YZkh85MEgAsuhW+7JJ7wqJTGreqbQfxsUOyBwJtw+68FNpim9090ZWxaq8CtxMfd0h2PSOgfKa5hYLKP1BTqtCU0LmGuzW3k628ss5FiCpR10I9BbwJfFRw3DwXSR/I67hXndYHBJTJpbLwRCoLNmNC6JFuj40asztLeK/S6pnApF9X1FhCHNhFe8oZYp5J42rgd+C1wBm1+uZs1uKullBLxdPYokuxHsmISek6lXMe69Jp3kvjPY27N6TgZTVaPVEVvBGT+r65xJ20VTJeDDWO5lkZAZYrHZYOK4Ov6EDW/ZKzK9T4lRqtiouBBcALCpU/AsdTnugEy9yC/AtTarTcJgaeD9ToxyMYYVgkeacJ4IwabSU7rSdwF+sK4BZ9Ns+0i/0B/TXHExQ2JKueaIXTkneTHvt8ooScfQH9uYbE3FqLgWOBrfUccbAob2vFOuxmxCHJOiZlJ2RE2tuVHPZRNRoDGMOILyId7BDW5IXf5EI08qwdrNC2/MGF2EMyqipszbsQkxTFGMA0ngTGMnKb25T3JOfg20hG9OiQW3qUxph0DYUGNlzSmM6pdooosLo8BKsNVjnqMwaWAL+KaUknt0nSeEnW4D2ajNGYHl0t2A7E785ENATpTFepD2uOb5ODB9XJuNgyuFERpSrMAw5qjmvzOtYUKq3jXcw9rNLcvivyGmJEnQ/OIvnQyCAfPtfcNhUR1u1oUiOU0xhQmyk8l3TQiNqOtPNSaFCDpkWOpTFQIUE3EPh9ucreZplXGdvcChTJvy4vQZkWKa4Wi5SzubxCCXSLFmqKSM4LvxcDP6vGLopx3U31FnInNIeJTt4z9rvVGM/xTJcuzRBRkIUtGtOV44kJ6baE9lI6xFJnjG2zG6gey51OM+KaWIL73TabFvdq4TA25is6JQd7IoYnQmcmCQBNEcqDEW9se5WR3BPJwa703ftK5/aEtd9YMhz3KndK0o6mtlLMt8UtvTPs0pmmMlJLr58V77RMwWGBnj69NFqjPmOOJ0jSjk2z9Q+Imljx3SoBmm0+Z1WZrp0tA7IKoSFVbW+JiJtyf6qZUvm7S32G8uqJ8+A/jr8AhPiCfYdSXbMAAAAASUVORK5CYII=">
                    </div>
                    <div class="col-span-2 flex flex-col">
                        <div class="caption">Pressure</div>
                        <div class="value">
                            {{ $this->getWeatherData()?->current('pressure') }}
                            <small>hPa</small>

                            @php($windDiff = $this->getWeatherData()?->pressureDiffWithPrev())
                            <div class="-mt-1">
                                @if($windDiff && $windDiff > 0)
                                <div class="flex items-center text-xs text-red-500">
                                    +{{ $windDiff }} hPa
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </div>
                                @elseif($windDiff && $windDiff < 0)
                                    <div
                                    class="flex items-center text-xs text-green-800">
                                    {{ $windDiff }} hPa
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                            </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overview">
                    <div class="icon">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAAEXUlEQVR4nO2ZX2hbVRzHL7bah2LuyUT6MsYqDhEVdWyFoXvSB/FB8F1BEBX3IMJ0lQ3n8EEKE5EpMhUEQVCKsoGgPlirnWMrTc5p0kpdtHT5nXvTdP2ztGnTm94/X0m6JCfTrc29N12F/OC8hPzO+X3O7885v3M1rSUtaUlL/teiC+MRXciXGJcPB5uH3mOCbCYkyoPLIhMypgs6og2iXWuGME6HmCBnfVFyojz9qt+5dE7LVeOvG7qQv4YOoceNJ2rGVwbZLJE+GIoHxPUQdCQ043ck5E4maLbO8NpumZ3Jya7Ai4yP38FE+pgCMRKK8RpwG+M0oBg8rSfMvbqQmVr80mAoLk+lOtScCMX++l0hOyrMx0q/69x4sj6k0sfCWU9WwyjwZJF4el99paDjdYtxelvdMX3UeHT7AAyinXES1dDhckjrR1vdf/rRpgs6r/wnqcVit28LAF3IXqUirOjJ9D3/9b9InO5VS2KUy7fCqkiaXykbJWShtrP0xs0NkK/XwYqp3WGcCZpfYYK+VSaKbVhh+tHGOHElH87cMg9EOO1nnLxrSeuVEnlTeoJ6GCe3Gkpx44Cf9VlQACboZ6Xmf92Irs7lV3VJv9UAevm6UKv5d3K5pzxpIn2w/iTe3Ihw49CWAjAh368oPz4xM3yhgN5zBfQemJgZbtT4a7kwuaUAO8cy+7uTpr1vIovfCi7iFnBxFTg9b2FX0vQBQO6Nym9TAAwbz1y2gb/XgD/XgGQRVYihAjCwAvywDJzJA98sefhy0cPnOQ8fXfVwcsHDu/Mejs55eGhiVgU5ubmyTW+qZ48vgIyDs4YNBIV4XhbUMJraaF3G5WTgc2Aa6Jx1sDrtAEEhTsx56ErUQm5HfOr+pgLoCXPv7qT514uX51ECCAOi59JcrTnhdHijEGKcjjNOfb4AGKfvKko/LlqYdYNDPEd5tUU8u2lbhB8AIUcqSkP5IhZcBIY4OlNUq9GlpgLoSnc1aTlYdBEY4tSCo3og11QAxqVVUbrqesi7CAzxRc5VE3JtyzxARQcFD4EhPluw1VKabSoAEzJWUTqfL8LyEBii74qlhBCNNvU6zTh9WlE6kcnB9hAY4oX0opoDnzS1oYly+XRF6cE/Mlh2vEAQAyseuscyqgeebaoHtFSqQ82DD7NLcDz4hjhsLqmHGDXS6DO/V4mIkK9UFLsSBi7mi74gflq2cXfCUBP4tUbsYL4vc+vPKNW+ds+Y6Qvi1OyKavzwv55iNpBAt9FozNzFOM1UPTFq4IPsUkM5kbTc1fvGMxd0Tr9XOrotfVqMlJtzmVV34oHxDN7J5HAubyFddJBzPaQsB78sFREr2DWINZiTa+i55Y+70XVPxDfTdd01KvH94qp1xUXfFMC2z/P6INp1IV+ue4W+wehOGje9Ljf6gYOF9dpdllSqIxqnpxin0yW3lr4HlB9yOclSnOtcftw1Ot0Z0iemkVJr2bRPTC1pSUtaogWVfwC9smlpGVSMFwAAAABJRU5ErkJggg==">
                    </div>
                    <div class="col-span-2 flex flex-col">
                        <div class="caption">Humidity</div>
                        <div class="value">
                            {{ $this->getWeatherData()?->current('humidity') }}
                            <small>%</small>

                            @php($windDiff = $this->getWeatherData()?->humidityDiffWithPrev())
                            <div class="-mt-1">
                                @if($windDiff && $windDiff > 0)
                                <div class="flex items-center text-xs text-red-500">
                                    +{{ $windDiff }} %
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                                    </svg>
                                </div>
                                @elseif($windDiff && $windDiff < 0)
                                    <div
                                    class="flex items-center text-xs text-green-800">
                                    {{ $windDiff }} %
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="w-3.5">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                                    </svg>
                            </div>
                            @endif
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </main>
        <aside>
            <div class="leading-loose">
                <div class="text-lg">{{ $this->getWeatherData()->country() ?? 'N/A' }}</div>
                <div class="text-slate-300">{{ $this->getWeatherData()->city() ?? 'N/A' }}</div>
                <div class="my-10 flex w-full justify-between items-center gap-6">
                    <div class="text-6xl">
                        {{ $this->getWeatherData()->current('airTemperature') }}ºC
                    </div>
                    <div class="text-lg px-4 py-1 capitalize rounded-full" style="background-color: {{ $this->getWeatherData()->backgroundColor() }}; color: {{ $this->getWeatherData()->textColor() }}">
                        {{ $this->getWeatherData()->beaufortScale() }}
                    </div>
                </div>
                <div class=" leading-tight">
                    @foreach ($this->getForecast() as $forecast)
                    <div title="Avg. temperature" class="flex justify-between gap-1 hover:bg-white hover:text-black hover:p-1.5 hover:-m-1.5 hover:mb-1.5 mb-3 relative z-10 group rounded">
                        <div>{{ $forecast->date->format('d.m') }}</div>
                        <div class="border-b border-dashed border-white grow group-hover:border-black -translate-y-1.5">&nbsp;</div>
                        <div>{{ $forecast->current_air_temperature_avg }}ºC</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </aside>
        @vite('resources/css/app.css')
    </div>

    <div class="pb-4"
        x-init='c3.generate({
                    bindto: "#weatherChart",
                    size: {
                        height: 320,
                        width: 1100
                    },
                    axis: {
                        y: { show: false },
                        x: {
                            show: false,
                            tick: { outer: false }
                        },
                    },
                    grid: {
                        y: { show: true },
                        x: { show: true }
                    },
                    data: {
                        labels: false,
                        names: {
                            AIR: "Air Temperature",
                            WATER: "Water Temperature",
                            WIND: "Wind Speed",
                            HUMIDITY: "Humidity",
                        },
                        columns: @json($this->getWeatherData()?->chartData()),
                        types: {
                            AIR: "spline",
                            WATER: "spline",
                            WIND: "bar",
                            HUMIDITY: "area-spline"
                        },
                        labels: {
                            format: {
                                AIR: (v, id, i) => i,
                                WATER: (v, id, i) => null,
                                WIND: (v, id, i) => i,
                                HUMIDITY: (v, id, i) => null,
                            }
                        },
                        colors: {
                            AIR: "green",
                            WATER: "gray",
                            WIND: "pink",
                            HUMIDITY: "skyblue"
                        },
                    }
                })'>
        <div id="weatherChart" class="text-black"></div>
    </div>
</div>
