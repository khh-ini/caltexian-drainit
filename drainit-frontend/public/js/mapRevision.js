const OpenInfo = document.getElementById('info-btn');
const info = document.getElementById('info');
const closeInfo = document.getElementById('close-info');
const infoBody = document.getElementById('info-body');

const OpenFilter = document.getElementById('filter-open');
const filter = document.getElementById('filter');
const filterTitle = document.getElementById('filter-title');
const closeFilter = document.getElementById('close-filter');
const filterBody = document.getElementById('filter-body');
const filterBtn = document.getElementById('filter-btn');
const noFilter = document.getElementById('no-filter');

let data = []
let backup = []
let markers = L.markerClusterGroup({
    chunkedLoading: true
});

//Map
let map = L.map("map").setView([0.5761342622590945, 101.45908355712892], 13);
const makeMap = () => {
    map.remove();
    markers = L.markerClusterGroup({
        chunkedLoading: true
    })
    map = L.map("map").setView([0.5761342622590945, 101.45908355712892], 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: `&copy; 
            <a href="https://www.openstreetmap.org/copyright">
                OpenStreetMap
            </a>
            contributors, 
            <a href="https://creativecommons.org/licenses/by-sa/2.0/">
                CC-BY-SA
            </a>`,
        tileSize: 512,
        zoomOffset: -1,
        // minZoom: 7
    }).addTo(map);
}

const randomColor = () => {
    return `rgb(${Math.floor(Math.random()*255)},${Math.floor(Math.random()*255)},${Math.floor(Math.random()*255)})`
}

const makeFilter = (result, obj) => {
    let option = [];
    for (let j = 0; j < result.length; j++) {
        let cek = false;
        for (let k = 0; k < result.length; k++) {
            if (result[j][obj] == option[k]) {
                cek = true;
                break;
            }
        }
        if (!cek) {
            option.push(result[j][obj])
        }
    }
    option.sort();
    return option;
}

const makeObj = () => {
    data.forEach(el => {
        let text = `<table class="table table-bordered">`;
        let foto = "";
        const geo = JSON.parse(el.geometry);
        Object.keys(el).forEach((key) => {
            if (key == "foto")
                foto = el[key];
            else if (key == "lebar" || key == "panjang" || key == "kedalaman") {
                text += `<tr>
                            <th>${key}</th>
                            <td>${el[key]} m</td>
                        </tr>`;
            } else if (key != "id" && key != "geometry") {
                text += `<tr>
                            <th style="width: 30%">${key}</th>
                            <td>${el[key]}</td>
                        </tr>`;
            }
        });
        text += `</table>
                <br/>
                Foto : <br/>
                <img 
                    src="http://gis-drainase.pocari.id/storage/app/public/images/${foto}"  
                    onerror="javascript:this.src='../assets/img/default.png'"
                    alt="${foto}" style="width: 100%; object-fit: cover;" />
                <br/>`

        let coord = geo.coordinates;
        if (geo.type == "Point") {
            [coord[0], coord[1]] = [coord[1], coord[0]];

            const obj = L.marker(coord)
            obj.text = text;

            obj.addEventListener('click', (e) => {
                infoBody.innerHTML = e.target.text;
                OpenInfo.click();
            })
            markers.addLayer(obj);
            map.addLayer(markers);
        } else {
            coord.forEach(el => {
                [el[0], el[1]] = [el[1], el[0]];
            });
            let xtot = 0,
                ytot = 0,
                num = 0;
            for (let idx = 0; idx < coord.length - 1; idx++) {
                const xabs = Math.abs(coord[idx][0] - coord[idx + 1][0]);
                const yabs = Math.abs(coord[idx][1] - coord[idx + 1][1]);
                xtot += xabs;
                ytot += yabs;
            }
            if (xtot < ytot) {
                num = 1
            }
            coord.sort(function (a, b) {
                if (a[num] === b[num]) {
                    return 0;
                } else {
                    return (a[num] < b[num]) ? -1 : 1;
                }
            })

            const obj = L.polyline(coord, {
                    color: randomColor(),
                    weight: 4
                })
                .addTo(map);

            obj.addEventListener('click', (e) => {
                infoBody.innerHTML = text;
                OpenInfo.click();
            })

            obj.addEventListener('mouseover', () => {
                obj.setStyle({
                    weight: 10
                })
            })

            obj.addEventListener('mouseout', () => {
                obj.setStyle({
                    weight: 4
                })
            })
        }
    })
}

const check = (first, second) => {
    let i = 0;
    for (let x = 0; x < first.length; x++) {
        if (i == second.length) return true;
        if (i < second.length && first[x].toLowerCase() == second[i].toLowerCase()) {
            i++;
        }
    }
    if (i != second.length) return false;
    return true;
}

//Info
OpenInfo.addEventListener('click', () => {
    info.classList.add('displayInfo');
});
closeInfo.addEventListener('click', () => {
    info.classList.remove('displayInfo');
});

//Filter
OpenFilter.addEventListener('click', () => {
    filter.classList.add('displayFilter');
});
closeFilter.addEventListener('click', () => {
    filter.classList.remove('displayFilter');
});
const choose = document.getElementById('chooseObj');
const url = "http://gis-drainase.pocari.id/api"
const tipe = ["drainase", "titik_banjir", "titik_tersumbat","kembali"]

for (let i = 0; i < choose.children.length; i++) {
    choose.children[i].addEventListener('click', (e) => {
        setTimeout(()=>{
            OpenFilter.classList.add('displayButton');
        },1000);
        
        infoBody.innerHTML = `<h3>Belum ada informasi yang diklik</h3>`;
        for (let j = 0; j < choose.children.length; j++) {
            choose.children[j].classList.remove('activeObj');
        }
        e.target.classList.toggle('activeObj');

        fetch(`${url}/${tipe[i]}`)
            .then(res => res.json())
            .then(result => {
                filter.classList.add('displayFilter');
                filterTitle.innerText = e.target.innerText;

                if(i == 0) {
                    let kondisi = makeFilter(result, "kondisi");
                    let html = `
                        <label>Kondisi Drainase</label>
                        <br />
                        <select id="filter-category">
                            <option value="Semua">Semua</option>
                    `
                    kondisi.forEach(el => {
                        html += `<option value="${el}">${el}</value>`
                    })
                    html += `    
                        </select>
                        <br />
                        <label>Nama Jalan</label>
                        <br />
                        <input type="text" id="filter-name" />
                    `
                    filterBody.innerHTML = html
                }
                else if (i == 1) {
                    let option = makeFilter(result, "kondisi_kerusakan");

                    let html = `
                        <label>Kondisi Kerusakan</label>
                        <br /> 
                        <select id="filter-category">
                            <option value="Semua">Semua</option>
                    `
                    option.forEach(el => {
                        html += `<option value="${el}">${el}</value>`
                    })
                    html += `    
                        </select>
                        <br />
                        <label>Nama Jalan</label>
                        <br />
                        <input type="text" id="filter-name" />
                    `
                    filterBody.innerHTML = html

                }
                else {
                    filterBody.innerHTML =
                        `
                        <label>Nama Jalan</label>
                        <br />
                        <input type="text" id="filter-name" />
                    `
                }

                makeMap()
                data = result;
                backup = data;
                makeObj();
            }).catch(err=>console.log(err)) 
    }) 
}

filterBtn.addEventListener('click', (e) => {
    info.classList.remove('displayInfo');
    noFilter.style.display = "none";
    const filterName = document.getElementById('filter-name');
    const title = e.target.parentNode.children[0].children[0].innerText;
    
    if(title == "Drainase") {
        const filterCat = document.getElementById('filter-category');
        if (filterCat.value != "Semua") {
            data = data.filter(el => {
                return el["kondisi"] == filterCat.value
            })
        } else  data = backup;
    }
    else if (title == "Banjir") {
        const filterCat = document.getElementById('filter-category');
        if (filterCat.value != "Semua") {
            data = data.filter(el => {
                return el["kondisi_kerusakan"] == filterCat.value
            })
        } else  data = backup;
    }
    if (filterName.value != "") {
        data = data.filter(el => {
            return check(el["nama_jalan"], filterName.value)
        })
    }
    if (data.length == 0 && filterName.value != "") {
        noFilter.innerText = "nama yang dicari tidak ditemukan";
        noFilter.style.display = "block";
    }
    makeMap();
    makeObj();
    data = backup;
})
makeMap()