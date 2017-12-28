var cy = cytoscape({
  container: document.getElementById('cy'), // container to render in
  elements: [ // list of graph elements to start with
  <?php foreach ($nodes as $node){ ?>
    { 
      group: 'nodes', data: { id: '<?php echo getNodeId($node); ?>' }, classes: '<?php echo getNodeClass($node); ?>'
    },
  <?php } ?>
  <?php foreach ($edges as $edge){ ?>
  {
    data: { id: '<?php echo getEdgeId($edge); ?>', source: '<?php echo getSourceId($edge); ?>', target: '<?php echo getDestId($edge); ?>', label: '<?php echo getEdgeWeight($edge); ?>', weight: <?php echo getEdgeWeight($edge); ?> }, classes: 'autorotate'
  },
  <?php } ?>
  ],

  style: [ // the stylesheet for the graph
  {
    selector: 'node',
    style: {
      'background-color': '#666',
      'label': 'data(id)'
    }
  },

  {
    selector: 'edge',
    style: {
      'label': 'data(label)',
      'width': 3,
      'line-color': '#ccc'
      //'target-arrow-color': '#ccc',
      //'target-arrow-shape': 'triangle'
    }
  },
  {
    selector: '.autorotate',
    style: {
      'edge-text-rotation': 'autorotate'
    }
  },
  {
    selector: '.initial',
    style: {
      'background-color': '#FFCC00'
    }
  },
  {
    selector: '.selected',
    style: {
      'line-color': '#00FF00',
      'background-color': '#66CC00'
    }
  },
  {
    selector: '.considered',
    style: {
      'line-color': '#FF0000',
      'background-color': '#66CC00'
    }
  }],

  layout: {
    name: 'random',

    fit: true, // whether to fit to viewport
    padding: 10, // fit padding
    boundingBox: undefined, // constrain layout bounds; { x1, y1, x2, y2 } or { x1, y1, w, h }
    animate: false, // whether to transition the node positions
    animationDuration: 500, // duration of animation in ms if enabled
    animationEasing: undefined, // easing of animation if enabled
    ready: undefined, // callback on layoutready
    stop: undefined // callback on layoutstop
  },

  // initial viewport state:
  zoom: 1,
  pan: { x: 0, y: 0 },

  // interaction options:
  minZoom: 0.5,
  maxZoom: 2,
  zoomingEnabled: true,
  userZoomingEnabled: true,
  panningEnabled: true,
  userPanningEnabled: false,
  boxSelectionEnabled: false,
  selectionType: 'single',
  touchTapThreshold: 8,
  desktopTapThreshold: 4,
  autolock: false,
  autoungrabify: false,
  autounselectify: false,

  // rendering options:
  headless: false,
  styleEnabled: true,
  hideEdgesOnViewport: false,
  hideLabelsOnViewport: false,
  textureOnViewport: false,
  motionBlur: true,
  motionBlurOpacity: 0.2,
  wheelSensitivity: 1,
  pixelRatio: 'auto'
});