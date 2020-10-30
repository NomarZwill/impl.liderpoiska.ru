export const DRAFT_ID = $('[data-ctor-draft-id]').data('ctor-draft-id');
export const PREVIEW_LINK = $('[data-ctor-preview-link]').data(
    'ctor-preview-link'
);
export const SAVE_LINK = $('[data-ctor-save-link]').data('ctor-save-link');

export const DRAFT_REL_FIELD = 'hc_draft_id';
export const BLOCK_REL_FIELD = 'hc_block_id';
export const BLOCK_REL_NAME = 'hcBlock';

export const GET_BLOCKS =
    '/hc-blocks/?fields=id,name,type&expand=blockTypeLabel';
export const API_DRAFT_BLOCKS = '/hc-draft-blocks/';
export const GET_DRAFT_BLOCKS = `${API_DRAFT_BLOCKS}?expand=${BLOCK_REL_NAME},fileTargets&sort=sort`;
export const POST_BLOCKS_SORTINGS = '/hc-draft-blocks/sort/';

export const POST_FILE = '/hc-file/upload/';
export const POST_FILE_FASTVIEW = '/hc-file/fast-view/';
export const POST_FILE_ATTRIBUTE = 'file_target_id';
export const FILE_INPUT_CLASS = 'file_upload';
export const FILE_INPUT_ATTRIBUTE = 'data-file_target_id';


export const BLOCK_SHARED_SETTINGS = [
    {
        title: 'Ширина блока',
        slug: 'size',
        type: 'select',
        variants: [
            { value: 's', label: 'Маленький', default: true },
            { value: 'm', label: 'Обычный' },
            { value: 'l', label: 'Большой' },
        ],
    },
    {
        title: 'Цветовая тема',
        slug: 'color',
        type: 'select',
        variants: [
            { value: 'default', label: 'Стандартный', default: true },
            { value: 'blue', label: 'Синий' },
            { value: 'yellow', label: 'Желтый' },
            { value: 'gray', label: 'Серый' },
        ],
    },
    {
        title: 'Отступы',
        slug: 'margin',
        type: 'select',
        variants: [
            { value: 'default', label: 'Обычный', default: true },
            { value: 'large', label: 'Большой' },
            { value: 'nomargin', label: 'Без отступов' },
        ],
    },
];
