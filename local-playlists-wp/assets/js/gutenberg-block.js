const { registerBlockType } = wp.blocks
const { select } = wp.data

registerBlockType('wp-local-playlists/video-player', {
  title: "Local Playlists WP",
  description: "Local Playlists WP",
  icon: "admin-media",
  category: "media",
  attributes: {
    id: {
      type: "string"
    }
  },
  edit: ({ setAttributes }) => {
    let id = '';
    if(select( 'core/block-editor' ).getSelectedBlock()) {
      id = select( 'core/block-editor' ).getSelectedBlock().clientId
      setAttributes({
        id: select( 'core/block-editor' ).getSelectedBlock().clientId
      })
    }
    return `Local Playlists WP`
  },
  save: () => null,
  example: {
    'preview' : true
  },
})