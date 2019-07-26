sensors = {
    motion: '',
    light: '',
    battery: ''
};

if (window.DeviceMotionEvent) {
    window.addEventListener("devicemotion", function (event) {
        sensors.motion = {
            x: event.accelerationIncludingGravity.x,
            y: event.accelerationIncludingGravity.y,
            z: event.accelerationIncludingGravity.z
        };

        document.getElementById('div1').innerHTML = ("Акселерометр:<br/>X="
            + event.accelerationIncludingGravity.x + "<br/>Y="
            + event.accelerationIncludingGravity.y + "<br/>Z="
            + event.accelerationIncludingGravity.z
        );
    }, false);
}

if (window.DeviceLightEvent) {
    window.addEventListener("devicelight", function (event) {
        sensors.light = event.value;
        document.getElementById('div2').innerHTML = ("Освещенность: " + event.value);
    }, false);
}

navigator.getBattery().then(function(battery) {
    updateBatteryStatus(battery);
    battery.addEventListener('levelchange', updateBatteryStatus);
});

function updateBatteryStatus(battery) {
    var level = battery.level * 100;

    sensors.battery = level;
    document.getElementById('div3').innerHTML = (level + "%");
}
