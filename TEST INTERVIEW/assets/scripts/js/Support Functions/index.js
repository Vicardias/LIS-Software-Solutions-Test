

let notyf = Message => {

    const notyf = new Notyf({
        types: [
            {
                type: 'info',
                background: 'blue',
                icon: false
            }
        ]
    });
    
    notyf.open({
        type: 'info',
        message: Message
    });

}