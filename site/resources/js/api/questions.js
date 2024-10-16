export const getQuestionsBreadcrumbs = (listData = {}) => {
    let links = [
        {href: '/',label: 'Главная'},
    ];
    const {
        page = 1,
        id = null,
        add = false,
        isDelete = false
    } = listData;
    links.push({
        href: getQuestionsRoute('list', {page: page}),
        label: 'Вопросы',
    });

    if(id !== null) {
        links.push({
            href: getQuestionsRoute('edit', {id: id}),
            label: 'Редактировать вопрос'
        });
    }
    if(add) {
        links.push({
            href: getQuestionsRoute('new'),
            label: 'Добавить вопрос'
        });
    }
    if(isDelete) {
        links.push({
            href: getQuestionsRoute('delete',{id: id}),
            label: 'Удалить вопрос'
        });
    }
    return links;
};

export const getQuestionListUriParams = (params) => {
    let uri = '';
    const {
        page = 1,
        searchStr = '',
        sortOrder = 'asc'
    } = params;
    const questionOrAmp = (value) => (value === '' ? '?':'&');
    if(page > 1) {
        uri+= questionOrAmp(uri) +'page=' +page;
    }
    if(searchStr !== ''){
        uri+= questionOrAmp(uri) +'name=' + searchStr;
    }
    if(sortOrder !== 'asc'){
        uri+= questionOrAmp(uri) +'sortOrder=' + sortOrder;
    }

    return uri;
};

export const axiosQuestionList = (page, searchStr, sortOrder, onfulfill) => {
    return axios.get(getQuestionsRoute('api.list',  {
        page: page,
        searchStr: searchStr,
        sortOrder: sortOrder
    } ))
        .then((r) => {
            const items = r.data.data.map((item) => ({
                ...item,
                title: item.name,
                secondary: item.category,
                edit_href: getQuestionsRoute('edit',{id: item.id})
            }));
            const pagination = r.data.pagination;
            onfulfill({
                items,
                pagination
            });
        });
};

export const axiosGetQuestion = (id, onfulfill, onfail) => {
    return axios.get(getQuestionsRoute('api.get',{id: id})).then((r) => {
        let data = r.data;
        data.is_enabled = data.is_enabled === 1;
        onfulfill(r.data);
    }, (r) => {
        onfail(r);
    });
};

export const axiosUpdateQuestion = (question) => {
    return axios.put(getQuestionsRoute('api.update', {id: question.id}), question);
};

export const axiosDeleteQuestion = (id) => {
    return axios.delete(getQuestionsRoute('api.delete',{id: id}));
};

export const axiosCreateQuestion = (question) => {
    return axios.post(getQuestionsRoute('api.create'), question);
};

export const getQuestionsRoute = (name, params = null) => {
    if(['api.get','api.update','api.delete'].indexOf(name) !== -1){
        return '/api/questions/' + params?.id;
    }
    if(name === 'api.list') {
        return '/api/questions' + getQuestionListUriParams(params);
    }
    if(name === 'api.create') {
        return '/api/questions';
    }
    if(name === 'new') {
        return '/questions/new';
    }
    if(name === 'delete') {
        return  '/questions/delete/' + params?.id;
    }
    if(name === 'edit') {
        return '/questions/edit/' + params?.id;
    }
    if(name === 'list') {
        const page = params?.id ?? 1;
        return '/questions' + (page > 1 ? '?page=' + page : '');
    }
    console.error('unknown route: ' + name);
    return '';
};
