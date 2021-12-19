<script>
    const currentUser = @json($currentUser);
    const user = @json($user);
    document.addEventListener('DOMContentLoaded', evt => {
        console.log('home show script', currentUser)
        /*setInterval(() => {
            console.log('timeout')
        }, 1000);*/

        getMessages()
    });

    function getMessages() {
        const data = {
            currentUserId: currentUser.id,
            userId: user.id
        }
        axios.post(`/api/messages/show-dialog`, data)
            .then(res => {
                console.log('getMessages res', res)
                if (res.data.success) {
                    let result = Object.keys(res.data.models).map((key) =>  res.data.models[key])
                    getRowHtml(result)
                }
            })
            .catch(err => {
                console.log('getMessages err', err)
            })
            .finally(() => {
                console.log('getMessages finally')
                setTimeout(() => {
                    getMessages()
                }, 3000); // Интервал обновления сообщений
            });
    }

    function getRowHtml(messages) {
        if (messages.length > 0) {
            messages = messages.sort((a, b) => a.id - b.id)
            console.log('htmlString ', messages)
            const htmlString = messages.map(msg => {
                if (msg.from === currentUser.id) {
                    return `
                        <li class="list-group-item" style="display:flex; justify-content: flex-end">
                            <div style="width: 80%">
                                <h4>Me</h4>
                                <p>${msg.msg}</p>
                                <span>${msg.created_at}</span>
                            </div>
                        </li>
                    `;
                } else {
                    return `
                        <li class="list-group-item" style="display:flex; justify-content: flex-start">
                            <div style="width: 80%">
                                <h4>${user.name}</h4>
                                <p>${msg.msg}</p>
                                <span>${msg.created_at}</span>
                            </div>
                        </li>
                    `
                }
            }).join('');
            document.getElementById('listGroup').innerHTML = htmlString
        }
    }
</script>
