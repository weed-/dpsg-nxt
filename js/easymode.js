function enableEasymode() {
    // console.log('enableEasymode()');
    renameEasymodeButton("Einfache Darstellung deaktivieren");
    window.sliderdisabled = true;

    // Seitenhintergrund entfernen
    const websiteBg = document.getElementById("background-container");
    if (websiteBg != null)
        websiteBg.style.backgroundImage = "none";

    // Footerhintergrund entfernen
    const footerBg = document.getElementsByTagName("footer")[0];
    if (footerBg != null)
        footerBg.style.backgroundImage = "none";

    
    const d1 = document.getElementById("page-content-container");
    if (d1 != null) {
        // Page: Textfarbe schwarz
        p1 = d1.getElementsByTagName("p");
        for (i = 0; i < p1.length; i++) {
            p1[i].style.color = "black";
        }

        // Page: Textfarbe Aufzählungspunkte schwarz
        p1 = d1.getElementsByTagName("li");
        for (i = 0; i < p1.length; i++) {
            p1[i].style.color = "black";
        }
    }

    // Home: Textvorschau in schwarz (li-postlist-item-content p)
    const d2 = document.getElementsByClassName("li-postlist-item-content");
    if (d2 != null) {
        for (i = 0; i < d2.length; i++) {
            const p2 = d2[i].getElementsByTagName("p");
            for (j = 0; j < p2.length; j++) {
                p2[j].style.color = "black";
            }
        }
    }

    // Hintergrundbild Kopfzeile ausblenden
    const headerImg = document.getElementById("img-header-container");
    if (headerImg != null) {
        headerImg.style.backgroundImage = "none";
    }

    // Textfarbe figcaption auf schwarz ändern
    const figcaptions = document.getElementsByTagName("figcaption");
    if (figcaptions != null) {
        for (i = 0; i < figcaptions.length; i++) {
            figcaptions[i].style.color = "black";
        }
    }

    // Textfarbe th, td in auf schwarz ändern
    const pcc = document.getElementById("page-content-container");
    if (pcc != null) {
        // td
        pcctd = pcc.getElementsByTagName("td");
        for (i = 0; i < pcctd.length; i++) {
            pcctd[i].style.color = "black";
        }

        // th
        pccth = pcc.getElementsByTagName("th");
        for (i = 0; i < pccth.length; i++) {
            pccth[i].style.color = "black";
        }
    }
}

function disableEasymode() {
    // console.log('disableEasymode()');
    // renameEasymodeButton("Einfache Darstellung aktivieren");
    window.sliderdisabled = false;
    location.reload(true); // Reload, damit alle Änderungen wieder auf den Standard zurückgesetzt werden
}

function checkEasymode() {
    // console.log('checkEasymode()');
    if (getValueByCookieName('easymode') === '1') {
        enableEasymode();
    }
}

function renameEasymodeButton(newText) {
    const btns = document.getElementsByClassName("link-easymode");
    for (i = 0; i < btns.length; i++) {
        btns[i].innerHTML = newText;
    }
}

function easymodeButtonHandler() {
    // TODO popup with info

    if (getValueByCookieName('easymode') === '1')
    {
        // console.log('mode was enabled');
        document.cookie = "easymode=0; path=/";
        disableEasymode();
    }
    else
    {
        // console.log('mode was disabled');
        document.cookie = "easymode=1; path=/";
        enableEasymode();
    }
}

function getValueByCookieName(cookiename)
{
    const cookielist = document.cookie.split(';');
    for (let i = 0; i < cookielist.length; i++) 
    {
        let c = cookielist[i].trim().split('=');

        if (c[0] === cookiename)
        {
            return c[1];
        }
    }
}