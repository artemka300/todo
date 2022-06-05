export async function authFetch(url,method = 'GET', body = null) {
    return await fetch(url, {
        method: method,
        body: body,
        headers: {
            "Authorization": 'Bearer ' + localStorage.getItem('token')
        }
    }).then(r => { return r });
}
