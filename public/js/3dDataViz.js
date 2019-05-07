function start3DdataViz() {
    if(display3dData) {
        document.getElementById('data_viz_cubes_update').setAttribute("style", "height:500px");
        let a = window.getComputedStyle(document.getElementById("data_viz_cubes_update"), null);
        console.log(a.getPropertyValue("width"));
        var d = parseInt(a.getPropertyValue("width").substring(0, a.getPropertyValue("width").length - 2));
        console.log(d);
        var canvasHeight = parseInt(a.getPropertyValue("height").substring(0, a.getPropertyValue("height").length - 2));
        var canvasWidth = 500;

        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(75, canvasWidth / canvasHeight, 0.1, 1000);
        var controls = new THREE.OrbitControls(camera);
        camera.position.z = 20;
        controls.update();

        $("#data_viz_cubes_update").hover(
            function () {
                noscroll()
            }
        );

        var noscroll_var;

        function noscroll() {
            if (noscroll_var) {
                document.getElementsByTagName("html")[0].style.overflowY = "";
                document.body.style.paddingRight = "0";
                controls.enableZoom = false;
                noscroll_var = false
            } else {
                document.getElementsByTagName("html")[0].setAttribute('style', 'overflow-y: hidden !important');
                document.body.style.paddingRight = "17px";
                controls.enableZoom = true;
                noscroll_var = true
            }
        }

        var renderer = new THREE.WebGLRenderer();
        renderer.setClearColor("#e3e0e5");
        renderer.setSize(canvasWidth, canvasHeight);
// renderer.vr.enabled = true;
        var canvas = document.getElementById('data_viz_cubes_update');
        canvas.appendChild(renderer.domElement);
        canvas.style.width = "750px";

        window.addEventListener('resize', () => {
            renderer.setSize(canvasWidth, canvasHeight);
            camera.aspect = canvasWidth / canvasHeight;
            camera.updateProjectionMatrix();
        });

        var raycaster = new THREE.Raycaster();
        var mouse = new THREE.Vector2();

        var geometry = new THREE.BoxGeometry(1, 1, 1);
        var material = new THREE.MeshLambertMaterial({color: "red", transparent: true});

        for (let i = 0; i < 8; i++) {
            let b = "";
            0 === i ? b = "Centrum" : 1 === i ? b = "Zuid" : 2 === i ? b = "West" : 3 === i ? b = "Oost" : 4 === i ? b = "Noord" : 5 === i ? b = "Nieuw-West" : 6 === i ? b = "Zuidoost" : 7 === i && (b = "Westpoort");
            var mesh = new THREE.Mesh(geometry, material);
            mesh.material.opacity = 1;
            mesh.name = b;
            mesh.position.x = (Math.random() - 0.5) * 20;
            mesh.position.y = (Math.random() - 0.5) * 20;
            mesh.position.z = (Math.random() - 0.5) * 20;
            scene.add(mesh);
        }

        var light = new THREE.PointLight('white', 1, 1000);
        light.position.set(0, 0, 0);
        scene.add(light);

        var render = function () {
            requestAnimationFrame(render);
            controls.update();
            renderer.render(scene, camera);
        };

        render();


        function onMouseMove(event) {
            event.preventDefault();

            var rect = event.target.getBoundingClientRect();
            mouse.x = ((event.clientX - rect.left) / canvasWidth) * 2 - 1;
            mouse.y = -((event.clientY - rect.top) / canvasHeight) * 2 + 1;
            raycaster.setFromCamera(mouse, camera);

            var intersects = raycaster.intersectObjects(scene.children, true);
            for (var i = 0; i < intersects.length; i++) {
                this.tl = new TimelineMax();
                console.log(intersects[i].object.name);
                this.tl.to(intersects[i].object.scale, 1, {x: 2, ease: Expo.easeOut});
                this.tl.to(intersects[i].object.scale, .5, {x: 1, ease: Expo.easeOut});
            }
        }

        window.addEventListener('mousemove', onMouseMove);
    }
}