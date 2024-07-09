<div>

    <div class="weather-collection"
        x-data="{ tab: 1 }">
        <div class="controlls">
            <a href="#"
                @click.prevent="tab = 4"
                :class="{'active': tab == 4}">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADM0lEQVR4nO2YXWjNYRzHP5szhkMbWnlZ3ssFk6glydVEq3m7wxoloVzYUCtXlgspu+BCeQkXSkQkonYx815E1LyMGTZFDZvXyPSs79HTOuf/ds7WuXi+dU6n8//+vs/vef6/t/8fHBwcBgJ5wErgCPAY6AJ6gO/AS+A4UEYWYxCwBXgnx/0+jcBUsgyTgbuWkw+BaqAUGKVNDgVmArVAu3ifgPkpNCcAm4CzwH3gA/BbtjeA3UBJJjexCOiUYyZ0KgLYjAROyaZTB5HAQuAy8DfAXTWcS5m4s0uBHxI9IweDIsfaTAMwHrhgOflNmquB2UCh8m8csAQ4CHSLa/JwWdRNLNBiRugAkBtBYwTQYRWDhFN1QEEA+zHAadn9ilJEShTfRuCoTjcqaq27cEUnHhb7Zd8eJiqKrWQ9r0ROB3Ol9SqNA8kF7khnRxCDAvUGY9AE5HtwTVw/UQXzcrDQCql0UCEdUz09MVy135CfAqM9uJOAz5awV/4Ms5I7HRRKx6ybEnFrE++BKT6ih6yYH+LDnSZumwdnHrBXfqRCvnRMFU2KIjWgRDLNwB+t4psG6IdKcU3pTYVGccqiHkiFNXK8BaYTDD9lMzgA95q4Wz04X8Qx4ZMK68S5mPjDhM164KZVFm+pWgVFoqr5bXyxuvNXn77RJb2xKa7nyEfD2YBVwnqsxKlWRw2Dw7K/CsRScOZofgpSMht8eNt0vSORR7eBj5p1NoYcOWwUWw3znkK0SIuYxN1nhd+5AL2oXFxjs1NNM66h9Jju6h9gOf2AUmv8SPYxC9d73LG+qPPQMjPXGvoRJjl3AQ/UJ7rUUOsjjuDlCrNuFYBHwB5gYj/47uDg4JBFyANWASeBZo0W3fp9Qu+zgvaFZIhJw7z7apZ2JvV7N2DeWb0J8GajTdwwY01Mk8TrgPqbw45NZoEqoMUSegHUALP0sBXX7xpds3lVPidoRpO1elALov/c4rVo4k2pH1fXjeJYmI2bYfRZhI1X9rEza22Xz/8fvJoyFCoDFYqtSfTMHnq/MplcA1EcVvQpDtfT0HNwcHDIUuS5WcsbbtbCzVrB4GatkIi5WcvBgdD4B4MBpSbd8QY3AAAAAElFTkSuQmCC">
            </a>
            <a href="#"
                @click.prevent="tab = 3"
                :class="{'active': tab == 3}">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAADWUlEQVR4nO1ZW0tVQRT+utiTWnSB9KEIUnuoyKLoJXqpMKyMsKd6q3zIx1IyE04JBhX9hC50owvd6CGzggojuphQWZ5eIoIsqEwFg+wUA2vgY5i9z8xpbz3U/mDB3mt9M7PWmZk1s/YBEiRI8F+hCEATgCcAhkTU8x4AhchzLAHwAcDvAHkPYLFHfxUAegGk5TlWlAP4GuK8li8A5jr0VwCgm9o9F11s6DCc3AagRGS7EVy7Q3/NluCb43J+Hg3yE8BSC2eZ2DRPzVgQ5gAYtgQwLLbIsYMGuR7Cu0E8NStBOEG8xyL6/XgM/mMfDdAWwmsjnmoTNJsjxFspot9H4tjQKRog9Ze8o8TpJP190h/O5wBeEmcL6beS/kU+BzBEnJmkLyG94uRtAJxu+bwoN9J03gbAmeo2gFkAZgO445jpIgugQq4O7wCUeQSgMk4m5CT/BWDFaASwl3RNHgEoNAYEkQHQELXzQY656oKwGsAtAAMi6nlVHM7HFcCoIpUEMMZIJTMwxjiWwwyoNrmgIuoys8HI1XUhAdQZ3F2eY02Kusw0T80r1KEtgALh8MHkc6o2R1lmKmd6qKNLACaIrQbAK7KpK3K12CYCuGzYlC4bykLKTH1V8UI1dfIRwFTRHwq5x7QKZxqAPtKvdRjvJvG7RPS7snnjFHVwQHQbQpzXUiXcVtKdzDJWlVFSVopw6bnGNwCunFRnCvccAminj2CuFVYncc+S/hzpH/gG8J0aT7ZUU0Gii5EppOsPGWe5cZWeT7YFRhJRn26cMUAN9TfPQY8Aikin+oJDkX/VYr9G9iM+AfRSw4Wiu+sQgN5wi0j3JmScbuJtsthrjXPBGWcsuXi9QwB6s7WQTiWEIPQTb7rFPoPs33wC2EwN+2RJKBwMcX6/cIoBfCa9+hVdlmqJxV7quBStB9lbanwewDixrZPlNCjSQelTcS5Su3SW68Aj4u4OKD+1/SE8sdH4hS/QTNhQbDifkbMjDPXE/yF3r1KRRtFp+07kAHPJfJLvnpWSnQrlucVYNtm+o/IFrsthbz3N9WI3Psu6t0lGnFdtXVAK4FkW5237wws1sp6zOZ92WDZBM1Ev61zvrU5ZNpH9c1MgGeU0gNc0UI+kytq4/yZKkCDBP4g/x7ctQUTRoRMAAAAASUVORK5CYII=">
            </a>
            <a href="#"
                @click.prevent="tab = 1"
                :class="{'active': tab == 1}"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAACXBIWXMAAAsTAAALEwEAmpwYAAABwUlEQVR4nO2Vu0oDQRSGPwSjeIkYBUVrn8AXiGjhBZEo+gqCGrCxEVHxmbROZYyFt05il6QUFS+IIKyM/AtD3HVnN2tlPjgwy8ycM+fMv2egTZv4jABHwDXwBjwBl8Ce5v6UAvAIeCF2Dyz9VfBl4FOBjoEpoBcYBGaAE82ZNfNpBx+2MjelDmNfa96BF+AVqABbQFcrBziQY5NlFH4lms3oZCxJ8FmgISfTDusnpJVRoF/jW+2/ADrjBD+0MjB325MkAyAH1OVn03XTgjZ8ADsSWyusyt9Z2IJuoAiUgQcFNhu2SYes/BlxZponx4GrAOF8amMa9Fl+K7YgM8CNJmrAisRjbNLReUH2Gx3AInCnWOf+r1m0gucSZtaQmXEUQ0BVMddROTxlnoRdq7Rm7MKa1p+aj2d9mJInwS+ppzGOVfAk9m9VtnIA///2r9GFAa1/tq8gSkRhgpvTIWrqmi6sKGbZFuGtgwjjCi6InCXCDfQr+D2gro6VTVFwPlllXrXehUxUIzJWiim45isqBfi8CHoZM3q3y5YwjeVjCC7oivJWCy6r7D9asStRgmvlilIhSU9IlSQ9IVWS9IQ2/5wvc4is7/DrzIsAAAAASUVORK5CYII=">

            </a>
        </div>
        <div class="title">
            <div class="text-xs uppercase">{{ $this->getWeatherData()?->country() }}, {{ $this->getWeatherData()?->city() }}</div>
            <div class="text-xl text-green-200">
                {{-- 12:00 | {{ $this->getWeatherData()['date']->format('l, n F Y') }} --}}
            </div>
            {{-- <div class="text-2xl text-black">{{ IpInfo::getCity() }}</div> --}}
        </div>
        <div class="text-[12px] bg-blue-400 py-1 px-3.5 bg-gradient-to-tl from-slate-500 to-slate-600 font-black">

            <span class="uppercase bg-white text-slate-900 -m-2 -ml-4 mr-2 p-2 px-5 shadow-inner shadow-black/70">
                {{ $this->getWeatherData()?->beaufortScale() }}
            </span>
            {{ date('H:i') }} | {{ $this->getWeatherData()?->date('l, j F Y') }}
        </div>
        <div class="flex flex-nowrap">
            <div class="weather-card"
                style="background-color: {{ $this->getWeatherData()?->backgroundColor() }}; color: {{ $this->getWeatherData()?->textColor() }};"
                x-show="tab == 1"
                x-init='c3.generate({
                bindto: "#airChart",
                size: {
                    height: 120,
                    width: 580
                },
                axis: {
                    y: {
                        show: false
                    },
                    x: {
                        show: false,
                        tick: {
                            outer: false
                        }
                    },
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
                        AIR: "area-spline",
                        WATER: "area-spline",
                        WIND: "bar",
                        HUMIDITY: "bar"
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
                        AIR: "black",
                        WATER: "blue",
                        WIND: "red",
                        HUMIDITY: "gray"
                    },
                }
            })'>
                <div class="grid grid-cols-12">
                    <div class="flex flex-col col-span-7 p-2">
                        <div class="grid grid-cols-2 shadow-lg shadow-black/20">
                            <div class="hover:to-yellow-400  cursor-pointer text-[12px] px-4 bg-gradient-to-br from-white/70 to-amber-200/80 py-2 font-black grid grid-cols-1 items-center leading-tight shadow-inner shadow-black/30 border border-white">
                                <div class="text-black/70">AIR TEMPERATURE</div>
                                <div class="font-light text-[30px] text-amber-600">
                                    {{ $this->getWeatherData()?->get('airTemperature') }}
                                    <small>ºC</small>
                                </div>
                            </div>
                            <div class="cursor-pointer bg-gradient-to-br hover:to-sky-300 from-white/70 to-sky-200/80 text-[12px] px-4  py-2 font-black grid grid-cols-1 items-center leading-tight shadow-inner shadow-black/30 border border-white">
                                <div class="text-black/70">WATER TEMPERATURE</div>
                                <div class="font-light text-[30px] text-blue-600">
                                    {{ $this->getWeatherData()?->get('waterTemperature') }}
                                    <small>ºC</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-5">
                        <div class="parameters">
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value">{{ $this->getWeatherData()?->get('humidity') }}%</div>
                                    <div class="label">Humidity</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value">{{ $this->getWeatherData()?->get('pressure') }} hPa</div>
                                    <div class="label">Pressure</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="airChart"
                    class="chart"></div>
            </div>
            <div class="weather-card water"
                x-show="tab == 3">
                <div class="grid grid-cols-2">
                    <div class="hover:to-yellow-400  cursor-pointer text-[12px] px-4 bg-gradient-to-br from-white/70 to-amber-200/80 py-2 font-black grid grid-cols-1 items-center leading-tight shadow-inner shadow-black/30 border border-white">
                        <div class="text-black/70">WATER TEMPERATURE</div>
                        <div class="font-light text-[30px] text-amber-600">
                            {{ $this->getWeatherData()?->get('waterTemperature') }}
                            <small>ºC</small>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="parameters">
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value">{{ $this->getWeatherData()?->get('waveDirection') }}º</div>
                                    <div class="label">Wave Direction</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value">{{ $this->getWeatherData()?->get('seaLevel') }}º</div>
                                    <div class="label">Sea Level</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value"
                                        title="Period of combined wind and swell waves in second">{{ $this->getWeatherData()?->get('wavePeriod') }} sec.</div>
                                    <div class="label">Wave Period</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value">{{ $this->getWeatherData()?->get('waveHeight') }} m.</div>
                                    <div class="label">Wave Height</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="weather-card wind"
                x-show="tab == 4">
                <div class="grid grid-cols-2">
                    <div class="hover:to-yellow-400  cursor-pointer text-[12px] px-4 bg-gradient-to-br from-white/70 to-amber-200/80 py-2 font-black grid grid-cols-1 items-center leading-tight shadow-inner shadow-black/30 border border-white">
                        <div class="text-black/70">WIND SPEED</div>
                        <div class="font-light text-[30px] text-amber-600">
                            {{ $this->getWeatherData()?->get('windSpeed') }}
                            <small>m. / sec.</small>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="parameters">
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value">{{ $this->getWeatherData()?->get('windDirection') }}º</div>
                                    <div class="label">Wind Direction</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value">{{ $this->getWeatherData()?->get('gust') }}º</div>
                                    <div class="label">Gust</div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="icon">
                                    <img src="data:image/png;base64,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">
                                </div>
                                <div>
                                    <div class="value">{{ $this->getWeatherData()?->get('visibility') }} m.</div>
                                    <div class="label">Visibility</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite('resources/css/app.css')
</div>
