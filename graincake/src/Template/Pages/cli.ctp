
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="chrome=1">
  <title>Josh.js by sdether</title>
  <link rel="stylesheet" href="stylesheets/styles.css">
  <link rel="stylesheet" href="stylesheets/pygment_trac.css">
  <link rel="stylesheet" href="stylesheets/tomorrow-night.css">
  <script src="javascripts/respond.js"></script>
  <!--[if lt IE 9]>
  <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <!--[if lt IE 8]>
  <link rel="stylesheet" href="stylesheets/ie.css">
  <![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link href='http://fonts.googleapis.com/css?family=Source+Code+Pro' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.2/underscore-min.js"></script>
  <script src="javascripts/highlight.min.js"></script>
  <script>hljs.initHighlightingOnLoad();</script>
  <script>Josh = {Debug: true };</script>
  <script src="javascripts/killring.js"></script>
  <script src="javascripts/history.js"></script>
  <script src="javascripts/readline.js"></script>
  <script src="javascripts/shell.js"></script>
  <script src="javascripts/pathhandler.js"></script>
  <style type="text/css">
    #shell-panel {
      height: 200px;
      width: 100%;
      background-color: #002f05;
      color: #00fe00;
      padding: 20px 20px 20px 20px;
      font-family: 'Source Code Pro';
      overflow: scroll;
      overflow-x: hidden;
      overflow-y: scroll;
      border: 1px dashed #E6EBE0;
    }

    #shell-cli .prompt {
      font-weight: bold;
    }</style>
  <script>
    $(document).ready(function() {
      var history = new Josh.History({ key: 'josh.helloworld'});
      var shell = Josh.Shell({history: history});
      var promptCounter = 0;
      shell.onNewPrompt(function(callback) {
        promptCounter++;
        callback("[" + promptCounter + "] $");
      });
      shell.setCommandHandler("hello", {
        exec: function(cmd, args, callback) {
          var arg = args[0] || '';
          var response = "who is this " + arg + " you are talking to?";
          if(arg === 'josh') {
            response = 'pleased to meet you.';
          } else if(arg === 'world') {
            response = 'world says hi.'
          } else if(!arg) {
            response = 'who are you saying hello to?';
          }
          callback(response);
        },
        completion: function(cmd, arg, line, callback) {
          callback(shell.bestMatch(arg, ['world', 'josh']))
        }
      });
      shell.activate();
    });</script>
</head>
<body>
<div id="header">
  <nav>
    <li><a href="index.html">Back to the Documentation</a></li>
  </nav>
</div>
<div class="wrapper">

  <section>
    <h1>Hello World Shell</h1>

    <p>This tutorial shows how easy it is to create the below shell window with a custom prompt and a new command
      <code>hello</code>.</p>

    <p>

    <div id="shell-panel">
      <div>Type <code>help</code> or hit <code>TAB</code> for a list of commands.</div>
      <div id="shell-view"></div>
    </div>
    <h2>Creating the Shell</h2>

    <p>The
      <code>Josh.Shell</code> uses local storage to store a history of the commands that you have typed. By default this is keyed with
      <em>josh.history</em>. That history is available to all instances of the shell on your site. For this tutorial, we want to make sure we have our own copy, so we don't get commands from other tutorials and examples, so we need to create a history object with its own key:
    </p>
    <pre><code>var history = new Josh.History({ key: 'helloworld.history'});</code></pre>
    <p>Now we can create a Shell instance with that history:</p>
    <pre><code>var shell = Josh.Shell({history: history});</code></pre>
    <p>Now the shell exists but has not yet been activated.</p>

    <p><em>Note on how the shell attaches to its UI elements:</em> By default
      <code>Josh.Shell</code> expects to find a <code>div#shell-panel</code> that contains a
      <code>div#shell-view</code>. The former is the physical container providing the dimensions of the shell, while the latter is a div the shell will continue to append to and scroll to mimic a screen. If you want to use other div IDs (because you have multiple shells on one page), you can provide
      <code>shell-panel-id</code> and <code>shell-view-id</code> in the constructor.</p>

    <h2>Rendering the prompt</h2>

    <p>The default prompt for Josh is
      <strong>jsh$</strong>. Let's create a prompt instead that keeps track of how many times it has been shown:
    </p>
        <pre><code>var promptCounter = 0;
shell.onNewPrompt(function(callback) {
    promptCounter++;
    callback("[" + promptCounter + "] $ ");
});</code></pre>
    <p>
      <code>onNewPrompt</code> is called every time Josh needs to re-render the prompt. This happens usually a command is executed, but can also happen on tab completion, when a list of possible completions is shown.
      <code>onNewPrompt</code> expects a function that accepts a callback as its only argument. Josh will not continue until the callback has been called with an html string to display. This allows the prompt to rendered as part of an asynchronous action. For our example, we just increment the promptCounter and send back a simple string with the counter.
    </p>

    <h2>Adding a new command</h2>

    <p>Josh implements just three commands out of the box:</p>
    <ul>
      <li><code>help</code> - show a list of known commands</li>
      <li><code>history</code> - show the commands previously entered</li>
      <li><code>clear</code> - clear the console (i.e. remove all children from <code>div#shell-view</code></li>
    </ul>
    <p>Let's add a new command called hello with tab completion:</p>
        <pre><code>shell.setCommandHandler("hello", {
    exec: function(cmd, args, callback) {
        var arg = args[0] || '';
        var response = "who is this " + arg + " you are talking to?";
        if(arg === 'josh') {
            response = 'pleased to meet you.';
        } else if(arg === 'world') {
            response = 'world says hi.'
        } else if(!arg) {
            response = 'who are you saying hello to?';
        }
        callback(response);
    },
    completion: function(cmd, arg, line, callback) {
        callback(shell.bestMatch(arg, ['world', 'josh']))
    }
});</code></pre>
    <p>To add a command, simply call <code>shell.setCommandHandler</code> and provide it at least an
      <code>exec</code> handler, and optionally a <code> completion</code> handler.</p>

    <p>
      <code>exec</code> expects a function that takes the name of the called command, an array of whitespace separated arguments to the command and a callback that MUST be called with an html string to output to the console. For our toy command we implement a command named
      <code>hello</code> which understands arguments <em>josh</em> and
      <em>world</em> and has alternate outputs for no arguments and unknown arguments.</p>

    <p>
      <code>completion</code> expects a function that takes the current command, the current argument being completed, the complete line (since the cursor may not be at the tail) and a callback that MUST be called either with a completion data structure. The format of this data structure is:
    </p>
        <pre><code>{
  completion: {string to append to current argument},
  suggestions: [{array of possible completions},...]
}</code></pre>
    <p>Here are some expected completions:</p>
    <ul>
      <li><code>hello &lt;TAB&gt;</code> => <code>{completion:null,suggestions:['world', 'josh']}</code></li>
      <li><code>hello wo&lt;TAB&gt;</code> => <code>{completion:'rld',suggestions:['world']}</code></li>
      <li><code>hello x&lt;TAB&gt;</code> => <code>{completion:'',suggestions:[]}</code></li>
    </ul>
    <p>To simplify this process of finding the partial strings and possible completions, Shell offers a method
      <code>bestMatch</code> which expects as input the partial to match (our arg to the completion handler) and a list of all possible completions and it will narrow down what to append to the partial and what suggestions to show.
    </p>

    <h2>Turning it on</h2>

    <p>Now that we've added our custom behavior to
      <code>Josh.Shell</code>, all we have to do is activate the shell to render the prompt and start capturing all keystrokes via readline (i.e. if you want the shell to only capture keys while the shell has focus, it is up to you to write focus and blur code to activate and deactivate the shell.)
    </p>
    <pre><code>shell.activate();</code></pre>
    <p>And that's all there is to getting a custom Bash-like shell in your web page.</p>
  </section>
</div>
<!--[if !IE]>
<script>fixScale(document);</script><![endif]-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-39420675-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>