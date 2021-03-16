/*!
 * jQuery JavaScript Library v1.11.3
 * http://jquery.com/
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 *
 * Copyright 2005, 2014 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2015-04-28T16:19Z
 */

(function( global, factory ) {

	if ( typeof module === "object" && typeof module.exports === "object" ) {
		// For CommonJS and CommonJS-like environments where a proper window is present,
		// execute the factory and get jQuery
		// For environments that do not inherently posses a window with a document
		// (such as Node.js), expose a jQuery-making factory as module.exports
		// This accentuates the need for the creation of a real window
		// e.g. var jQuery = require("jquery")(window);
		// See ticket #14549 for more info
		module.exports = global.document ?
			factory( global, true ) :
			function( w ) {
				if ( !w.document ) {
					throw new Error( "jQuery requires a window with a document" );
				}
				return factory( w );
			};
	} else {
		factory( global );
	}

// Pass this if window is not defined yet
}(typeof window !== "undefined" ? window : this, function( window, noGlobal ) {

// Can't do this because several apps including ASP.NET trace
// the stack via arguments.caller.callee and Firefox dies if
// you try to trace through "use strict" call chains. (#13335)
// Support: Firefox 18+
//

var deletedIds = [];

var slice = deletedIds.slice;

var concat = deletedIds.concat;

var push = deletedIds.push;

var indexOf = deletedIds.indexOf;

var class2type = {};

var toString = class2type.toString;

var hasOwn = class2type.hasOwnProperty;

var support = {};



var
	version = "1.11.3",

	// Define a local copy of jQuery
	jQuery = function( selector, context ) {
		// The jQuery object is actually just the init constructor 'enhanced'
		// Need init if jQuery is called (just allow error to be thrown if not included)
		return new jQuery.fn.init( selector, context );
	},

	// Support: Android<4.1, IE<9
	// Make sure we trim BOM and NBSP
	rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,

	// Matches dashed string for camelizing
	rmsPrefix = /^-ms-/,
	rdashAlpha = /-([\da-z])/gi,

	// Used by jQuery.camelCase as callback to replace()
	fcamelCase = function( all, letter ) {
		return letter.toUpperCase();
	};

jQuery.fn = jQuery.prototype = {
	// The current version of jQuery being used
	jquery: version,

	constructor: jQuery,

	// Start with an empty selector
	selector: "",

	// The default length of a jQuery object is 0
	length: 0,

	toArray: function() {
		return slice.call( this );
	},

	// Get the Nth element in the matched element set OR
	// Get the whole matched element set as a clean array
	get: function( num ) {
		return num != null ?

			// Return just the one element from the set
			( num < 0 ? this[ num + this.length ] : this[ num ] ) :

			// Return all the elements in a clean array
			slice.call( this );
	},

	// Take an array of elements and push it onto the stack
	// (returning the new matched element set)
	pushStack: function( elems ) {

		// Build a new jQuery matched element set
		var ret = jQuery.merge( this.constructor(), elems );

		// Add the old object onto the stack (as a reference)
		ret.prevObject = this;
		ret.context = this.context;

		// Return the newly-formed element set
		return ret;
	},

	// Execute a callback for every element in the matched set.
	// (You can seed the arguments with an array of args, but this is
	// only used internally.)
	each: function( callback, args ) {
		return jQuery.each( this, callback, args );
	},

	map: function( callback ) {
		return this.pushStack( jQuery.map(this, function( elem, i ) {
			return callback.call( elem, i, elem );
		}));
	},

	slice: function() {
		return this.pushStack( slice.apply( this, arguments ) );
	},

	first: function() {
		return this.eq( 0 );
	},

	last: function() {
		return this.eq( -1 );
	},

	eq: function( i ) {
		var len = this.length,
			j = +i + ( i < 0 ? len : 0 );
		return this.pushStack( j >= 0 && j < len ? [ this[j] ] : [] );
	},

	end: function() {
		return this.prevObject || this.constructor(null);
	},

	// For internal use only.
	// Behaves like an Array's method, not like a jQuery method.
	push: push,
	sort: deletedIds.sort,
	splice: deletedIds.splice
};

jQuery.extend = jQuery.fn.extend = function() {
	var src, copyIsArray, copy, name, options, clone,
		target = arguments[0] || {},
		i = 1,
		length = arguments.length,
		deep = false;

	// Handle a deep copy situation
	if ( typeof target === "boolean" ) {
		deep = target;

		// skip the boolean and the target
		target = arguments[ i ] || {};
		i++;
	}

	// Handle case when target is a string or something (possible in deep copy)
	if ( typeof target !== "object" && !jQuery.isFunction(target) ) {
		target = {};
	}

	// extend jQuery itself if only one argument is passed
	if ( i === length ) {
		target = this;
		i--;
	}

	for ( ; i < length; i++ ) {
		// Only deal with non-null/undefined values
		if ( (options = arguments[ i ]) != null ) {
			// Extend the base object
			for ( name in options ) {
				src = target[ name ];
				copy = options[ name ];

				// Prevent never-ending loop
				if ( target === copy ) {
					continue;
				}

				// Recurse if we're merging plain objects or arrays
				if ( deep && copy && ( jQuery.isPlainObject(copy) || (copyIsArray = jQuery.isArray(copy)) ) ) {
					if ( copyIsArray ) {
						copyIsArray = false;
						clone = src && jQuery.isArray(src) ? src : [];

					} else {
						clone = src && jQuery.isPlainObject(src) ? src : {};
					}

					// Never move original objects, clone them
					target[ name ] = jQuery.extend( deep, clone, copy );

				// Don't bring in undefined values
				} else if ( copy !== undefined ) {
					target[ name ] = copy;
				}
			}
		}
	}

	// Return the modified object
	return target;
};

jQuery.extend({
	// Unique for each copy of jQuery on the page
	expando: "jQuery" + ( version + Math.random() ).replace( /\D/g, "" ),

	// Assume jQuery is ready without the ready module
	isReady: true,

	error: function( msg ) {
		throw new Error( msg );
	},

	noop: function() {},

	// See test/unit/core.js for details concerning isFunction.
	// Since version 1.3, DOM methods and functions like alert
	// aren't supported. They return false on IE (#2968).
	isFunction: function( obj ) {
		return jQuery.type(obj) === "function";
	},

	isArray: Array.isArray || function( obj ) {
		return jQuery.type(obj) === "array";
	},

	isWindow: function( obj ) {
		/* jshint eqeqeq: false */
		return obj != null && obj == obj.window;
	},

	isNumeric: function( obj ) {
		// parseFloat NaNs numeric-cast false positives (null|true|false|"")
		// ...but misinterprets leading-number strings, particularly hex literals ("0x...")
		// subtraction forces infinities to NaN
		// adding 1 corrects loss of precision from parseFloat (#15100)
		return !jQuery.isArray( obj ) && (obj - parseFloat( obj ) + 1) >= 0;
	},

	isEmptyObject: function( obj ) {
		var name;
		for ( name in obj ) {
			return false;
		}
		return true;
	},

	isPlainObject: function( obj ) {
		var key;

		// Must be an Object.
		// Because of IE, we also have to check the presence of the constructor property.
		// Make sure that DOM nodes and window objects don't pass through, as well
		if ( !obj || jQuery.type(obj) !== "object" || obj.nodeType || jQuery.isWindow( obj ) ) {
			return false;
		}

		try {
			// Not own constructor property must be Object
			if ( obj.constructor &&
				!hasOwn.call(obj, "constructor") &&
				!hasOwn.call(obj.constructor.prototype, "isPrototypeOf") ) {
				return false;
			}
		} catch ( e ) {
			// IE8,9 Will throw exceptions on certain host objects #9897
			return false;
		}

		// Support: IE<9
		// Handle iteration over inherited properties before own properties.
		if ( support.ownLast ) {
			for ( key in obj ) {
				return hasOwn.call( obj, key );
			}
		}

		// Own properties are enumerated firstly, so to speed up,
		// if last one is own, then all properties are own.
		for ( key in obj ) {}

		return key === undefined || hasOwn.call( obj, key );
	},

	type: function( obj ) {
		if ( obj == null ) {
			return obj + "";
		}
		return typeof obj === "object" || typeof obj === "function" ?
			class2type[ toString.call(obj) ] || "object" :
			typeof obj;
	},

	// Evaluates a script in a global context
	// Workarounds based on findings by Jim Driscoll
	// http://weblogs.java.net/blog/driscoll/archive/2009/09/08/eval-javascript-global-context
	globalEval: function( data ) {
		if ( data && jQuery.trim( data ) ) {
			// We use execScript on Internet Explorer
			// We use an anonymous function so that context is window
			// rather than jQuery in Firefox
			( window.execScript || function( data ) {
				window[ "eval" ].call( window, data );
			} )( data );
		}
	},

	// Convert dashed to camelCase; used by the css and data modules
	// Microsoft forgot to hump their vendor prefix (#9572)
	camelCase: function( string ) {
		return string.replace( rmsPrefix, "ms-" ).replace( rdashAlpha, fcamelCase );
	},

	nodeName: function( elem, name ) {
		return elem.nodeName && elem.nodeName.toLowerCase() === name.toLowerCase();
	},

	// args is for internal usage only
	each: function( obj, callback, args ) {
		var value,
			i = 0,
			length = obj.length,
			isArray = isArraylike( obj );

		if ( args ) {
			if ( isArray ) {
				for ( ; i < length; i++ ) {
					value = callback.apply( obj[ i ], args );

					if ( value === false ) {
						break;
					}
				}
			} else {
				for ( i in obj ) {
					value = callback.apply( obj[ i ], args );

					if ( value === false ) {
						break;
					}
				}
			}

		// A special, fast, case for the most common use of each
		} else {
			if ( isArray ) {
				for ( ; i < length; i++ ) {
					value = callback.call( obj[ i ], i, obj[ i ] );

					if ( value === false ) {
						break;
					}
				}
			} else {
				for ( i in obj ) {
					value = callback.call( obj[ i ], i, obj[ i ] );

					if ( value === false ) {
						break;
					}
				}
			}
		}

		return obj;
	},

	// Support: Android<4.1, IE<9
	trim: function( text ) {
		return text == null ?
			"" :
			( text + "" ).replace( rtrim, "" );
	},

	// results is for internal usage only
	makeArray: function( arr, results ) {
		var ret = results || [];

		if ( arr != null ) {
			if ( isArraylike( Object(arr) ) ) {
				jQuery.merge( ret,
					typeof arr === "string" ?
					[ arr ] : arr
				);
			} else {
				push.call( ret, arr );
			}
		}

		return ret;
	},

	inArray: function( elem, arr, i ) {
		var len;

		if ( arr ) {
			if ( indexOf ) {
				return indexOf.call( arr, elem, i );
			}

			len = arr.length;
			i = i ? i < 0 ? Math.max( 0, len + i ) : i : 0;

			for ( ; i < len; i++ ) {
				// Skip accessing in sparse arrays
				if ( i in arr && arr[ i ] === elem ) {
					return i;
				}
			}
		}

		return -1;
	},

	merge: function( first, second ) {
		var len = +second.length,
			j = 0,
			i = first.length;

		while ( j < len ) {
			first[ i++ ] = second[ j++ ];
		}

		// Support: IE<9
		// Workaround casting of .length to NaN on otherwise arraylike objects (e.g., NodeLists)
		if ( len !== len ) {
			while ( second[j] !== undefined ) {
				first[ i++ ] = second[ j++ ];
			}
		}

		first.length = i;

		return first;
	},

	grep: function( elems, callback, invert ) {
		var callbackInverse,
			matches = [],
			i = 0,
			length = elems.length,
			callbackExpect = !invert;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( ; i < length; i++ ) {
			callbackInverse = !callback( elems[ i ], i );
			if ( callbackInverse !== callbackExpect ) {
				matches.push( elems[ i ] );
			}
		}

		return matches;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var value,
			i = 0,
			length = elems.length,
			isArray = isArraylike( elems ),
			ret = [];

		// Go through the array, translating each of the items to their new values
		if ( isArray ) {
			for ( ; i < length; i++ ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}

		// Go through every key on the object,
		} else {
			for ( i in elems ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}
		}

		// Flatten any nested arrays
		return concat.apply( [], ret );
	},

	// A global GUID counter for objects
	guid: 1,

	// Bind a function to a context, optionally partially applying any
	// arguments.
	proxy: function( fn, context ) {
		var args, proxy, tmp;

		if ( typeof context === "string" ) {
			tmp = fn[ context ];
			context = fn;
			fn = tmp;
		}

		// Quick check to determine if target is callable, in the spec
		// this throws a TypeError, but we will just return undefined.
		if ( !jQuery.isFunction( fn ) ) {
			return undefined;
		}

		// Simulated bind
		args = slice.call( arguments, 2 );
		proxy = function() {
			return fn.apply( context || this, args.concat( slice.call( arguments ) ) );
		};

		// Set the guid of unique handler to the same of original handler, so it can be removed
		proxy.guid = fn.guid = fn.guid || jQuery.guid++;

		return proxy;
	},

	now: function() {
		return +( new Date() );
	},

	// jQuery.support is not used in Core but other projects attach their
	// properties to it so it needs to exist.
	support: support
});

// Populate the class2type map
jQuery.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(i, name) {
	class2type[ "[object " + name + "]" ] = name.toLowerCase();
});

function isArraylike( obj ) {

	// Support: iOS 8.2 (not reproducible in simulator)
	// `in` check used to prevent JIT error (gh-2145)
	// hasOwn isn't used here due to false negatives
	// regarding Nodelist length in IE
	var length = "length" in obj && obj.length,
		type = jQuery.type( obj );

	if ( type === "function" || jQuery.isWindow( obj ) ) {
		return false;
	}

	if ( obj.nodeType === 1 && length ) {
		return true;
	}

	return type === "array" || length === 0 ||
		typeof length === "number" && length > 0 && ( length - 1 ) in obj;
}
var Sizzle =
/*!
 * Sizzle CSS Selector Engine v2.2.0-pre
 * http://sizzlejs.com/
 *
 * Copyright 2008, 2014 jQuery Foundation, Inc. and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2014-12-16
 */
(function( window ) {

var i,
	support,
	Expr,
	getText,
	isXML,
	tokenize,
	compile,
	select,
	outermostContext,
	sortInput,
	hasDuplicate,

	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,

	// Instance-specific data
	expando = "sizzle" + 1 * new Date(),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
		}
		return 0;
	},

	// General-purpose constants
	MAX_NEGATIVE = 1 << 31,

	// Instance methods
	hasOwn = ({}).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	push_native = arr.push,
	push = arr.push,
	slice = arr.slice,
	// Use a stripped-down indexOf as it's faster than native
	// http://jsperf.com/thor-indexof-vs-for/5
	indexOf = function( list, elem ) {
		var i = 0,
			len = list.length;
		for ( ; i < len; i++ ) {
			if ( list[i] === elem ) {
				return i;
			}
		}
		return -1;
	},

	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",

	// Regular expressions

	// Whitespace characters http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",
	// http://www.w3.org/TR/css3-syntax/#characters
	characterEncoding = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",

	// Loosely modeled on CSS identifier characters
	// An unquoted value should be a CSS identifier http://www.w3.org/TR/css3-selectors/#attribute-selectors
	// Proper syntax: http://www.w3.org/TR/CSS21/syndata.html#value-def-identifier
	identifier = characterEncoding.replace( "w", "w#" ),

	// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + characterEncoding + ")(?:" + whitespace +
		// Operator (capture 2)
		"*([*^$|!~]?=)" + whitespace +
		// "Attribute values must be CSS identifiers [capture 5] or strings [capture 3 or capture 4]"
		"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + identifier + "))|)" + whitespace +
		"*\\]",

	pseudos = ":(" + characterEncoding + ")(?:\\((" +
		// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
		// 1. quoted (capture 3; capture 4 or capture 5)
		"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|" +
		// 2. simple (capture 6)
		"((?:\\\\.|[^\\\\()[\\]]|" + attributes + ")*)|" +
		// 3. anything else (capture 2)
		".*" +
		")\\)|)",

	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rwhitespace = new RegExp( whitespace + "+", "g" ),
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" + whitespace + "+$", "g" ),

	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace + "*" ),

	rattributeQuotes = new RegExp( "=" + whitespace + "*([^\\]'\"]*?)" + whitespace + "*\\]", "g" ),

	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),

	matchExpr = {
		"ID": new RegExp( "^#(" + characterEncoding + ")" ),
		"CLASS": new RegExp( "^\\.(" + characterEncoding + ")" ),
		"TAG": new RegExp( "^(" + characterEncoding.replace( "w", "w*" ) + ")" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + whitespace +
			"*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" + whitespace +
			"*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),
		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
			whitespace + "*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},

	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,

	rnative = /^[^{]+\{\s*\[native \w/,

	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,

	rsibling = /[+~]/,
	rescape = /'|\\/g,

	// CSS escapes http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\([\\da-f]{1,6}" + whitespace + "?|(" + whitespace + ")|.)", "ig" ),
	funescape = function( _, escaped, escapedWhitespace ) {
		var high = "0x" + escaped - 0x10000;
		// NaN means non-codepoint
		// Support: Firefox<24
		// Workaround erroneous numeric interpretation of +"0x"
		return high !== high || escapedWhitespace ?
			escaped :
			high < 0 ?
				// BMP codepoint
				String.fromCharCode( high + 0x10000 ) :
				// Supplemental Plane codepoint (surrogate pair)
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	},

	// Used for iframes
	// See setDocument()
	// Removing the function wrapper causes a "Permission Denied"
	// error in IE
	unloadHandler = function() {
		setDocument();
	};

// Optimize for push.apply( _, NodeList )
try {
	push.apply(
		(arr = slice.call( preferredDoc.childNodes )),
		preferredDoc.childNodes
	);
	// Support: Android<4.0
	// Detect silently failing push.apply
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?

		// Leverage slice if possible
		function( target, els ) {
			push_native.apply( target, slice.call(els) );
		} :

		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;
			// Can't trust NodeList.length
			while ( (target[j++] = els[i++]) ) {}
			target.length = j - 1;
		}
	};
}

function Sizzle( selector, context, results, seed ) {
	var match, elem, m, nodeType,
		// QSA vars
		i, groups, old, nid, newContext, newSelector;

	if ( ( context ? context.ownerDocument || context : preferredDoc ) !== document ) {
		setDocument( context );
	}

	context = context || document;
	results = results || [];
	nodeType = context.nodeType;

	if ( typeof selector !== "string" || !selector ||
		nodeType !== 1 && nodeType !== 9 && nodeType !== 11 ) {

		return results;
	}

	if ( !seed && documentIsHTML ) {

		// Try to shortcut find operations when possible (e.g., not under DocumentFragment)
		if ( nodeType !== 11 && (match = rquickExpr.exec( selector )) ) {
			// Speed-up: Sizzle("#ID")
			if ( (m = match[1]) ) {
				if ( nodeType === 9 ) {
					elem = context.getElementById( m );
					// Check parentNode to catch when Blackberry 4.6 returns
					// nodes that are no longer in the document (jQuery #6963)
					if ( elem && elem.parentNode ) {
						// Handle the case where IE, Opera, and Webkit return items
						// by name instead of ID
						if ( elem.id === m ) {
							results.push( elem );
							return results;
						}
					} else {
						return results;
					}
				} else {
					// Context is not a document
					if ( context.ownerDocument && (elem = context.ownerDocument.getElementById( m )) &&
						contains( context, elem ) && elem.id === m ) {
						results.push( elem );
						return results;
					}
				}

			// Speed-up: Sizzle("TAG")
			} else if ( match[2] ) {
				push.apply( results, context.getElementsByTagName( selector ) );
				return results;

			// Speed-up: Sizzle(".CLASS")
			} else if ( (m = match[3]) && support.getElementsByClassName ) {
				push.apply( results, context.getElementsByClassName( m ) );
				return results;
			}
		}

		// QSA path
		if ( support.qsa && (!rbuggyQSA || !rbuggyQSA.test( selector )) ) {
			nid = old = expando;
			newContext = context;
			newSelector = nodeType !== 1 && selector;

			// qSA works strangely on Element-rooted queries
			// We can work around this by specifying an extra ID on the root
			// and working up from there (Thanks to Andrew Dupont for the technique)
			// IE 8 doesn't work on object elements
			if ( nodeType === 1 && context.nodeName.toLowerCase() !== "object" ) {
				groups = tokenize( selector );

				if ( (old = context.getAttribute("id")) ) {
					nid = old.replace( rescape, "\\$&" );
				} else {
					context.setAttribute( "id", nid );
				}
				nid = "[id='" + nid + "'] ";

				i = groups.length;
				while ( i-- ) {
					groups[i] = nid + toSelector( groups[i] );
				}
				newContext = rsibling.test( selector ) && testContext( context.parentNode ) || context;
				newSelector = groups.join(",");
			}

			if ( newSelector ) {
				try {
					push.apply( results,
						newContext.querySelectorAll( newSelector )
					);
					return results;
				} catch(qsaError) {
				} finally {
					if ( !old ) {
						context.removeAttribute("id");
					}
				}
			}
		}
	}

	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}

/**
 * Create key-value caches of limited size
 * @returns {Function(string, Object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function createCache() {
	var keys = [];

	function cache( key, value ) {
		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key + " " ) > Expr.cacheLength ) {
			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return (cache[ key + " " ] = value);
	}
	return cache;
}

/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}

/**
 * Support testing using an element
 * @param {Function} fn Passed the created div and expects a boolean result
 */
function assert( fn ) {
	var div = document.createElement("div");

	try {
		return !!fn( div );
	} catch (e) {
		return false;
	} finally {
		// Remove from its parent by default
		if ( div.parentNode ) {
			div.parentNode.removeChild( div );
		}
		// release memory in IE
		div = null;
	}
}

/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function addHandle( attrs, handler ) {
	var arr = attrs.split("|"),
		i = attrs.length;

	while ( i-- ) {
		Expr.attrHandle[ arr[i] ] = handler;
	}
}

/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			( ~b.sourceIndex || MAX_NEGATIVE ) -
			( ~a.sourceIndex || MAX_NEGATIVE );

	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}

	// Check if b follows a
	if ( cur ) {
		while ( (cur = cur.nextSibling) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}

	return a ? 1 : -1;
}

/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return (name === "input" || name === "button") && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function createPositionalPseudo( fn ) {
	return markFunction(function( argument ) {
		argument = +argument;
		return markFunction(function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;

			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ (j = matchIndexes[i]) ] ) {
					seed[j] = !(matches[j] = seed[j]);
				}
			}
		});
	});
}

/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function testContext( context ) {
	return context && typeof context.getElementsByTagName !== "undefined" && context;
}

// Expose support vars for convenience
support = Sizzle.support = {};

/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
isXML = Sizzle.isXML = function( elem ) {
	// documentElement is verified for cases where it doesn't yet exist
	// (such as loading iframes in IE - #4833)
	var documentElement = elem && (elem.ownerDocument || elem).documentElement;
	return documentElement ? documentElement.nodeName !== "HTML" : false;
};

/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
setDocument = Sizzle.setDocument = function( node ) {
	var hasCompare, parent,
		doc = node ? node.ownerDocument || node : preferredDoc;

	// If no document and documentElement is available, return
	if ( doc === document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}

	// Set our document
	document = doc;
	docElem = doc.documentElement;
	parent = doc.defaultView;

	// Support: IE>8
	// If iframe document is assigned to "document" variable and if iframe has been reloaded,
	// IE will throw "permission denied" error when accessing "document" variable, see jQuery #13936
	// IE6-8 do not support the defaultView property so parent will be undefined
	if ( parent && parent !== parent.top ) {
		// IE11 does not have attachEvent, so all must suffer
		if ( parent.addEventListener ) {
			parent.addEventListener( "unload", unloadHandler, false );
		} else if ( parent.attachEvent ) {
			parent.attachEvent( "onunload", unloadHandler );
		}
	}

	/* Support tests
	---------------------------------------------------------------------- */
	documentIsHTML = !isXML( doc );

	/* Attributes
	---------------------------------------------------------------------- */

	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties
	// (excepting IE8 booleans)
	support.attributes = assert(function( div ) {
		div.className = "i";
		return !div.getAttribute("className");
	});

	/* getElement(s)By*
	---------------------------------------------------------------------- */

	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert(function( div ) {
		div.appendChild( doc.createComment("") );
		return !div.getElementsByTagName("*").length;
	});

	// Support: IE<9
	support.getElementsByClassName = rnative.test( doc.getElementsByClassName );

	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert(function( div ) {
		docElem.appendChild( div ).id = expando;
		return !doc.getElementsByName || !doc.getElementsByName( expando ).length;
	});

	// ID find and filter
	if ( support.getById ) {
		Expr.find["ID"] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var m = context.getElementById( id );
				// Check parentNode to catch when Blackberry 4.6 returns
				// nodes that are no longer in the document #6963
				return m && m.parentNode ? [ m ] : [];
			}
		};
		Expr.filter["ID"] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute("id") === attrId;
			};
		};
	} else {
		// Support: IE6/7
		// getElementById is not reliable as a find shortcut
		delete Expr.find["ID"];

		Expr.filter["ID"] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== "undefined" && elem.getAttributeNode("id");
				return node && node.value === attrId;
			};
		};
	}

	// Tag
	Expr.find["TAG"] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== "undefined" ) {
				return context.getElementsByTagName( tag );

			// DocumentFragment nodes don't have gEBTN
			} else if ( support.qsa ) {
				return context.querySelectorAll( tag );
			}
		} :

		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,
				// By happy coincidence, a (broken) gEBTN appears on DocumentFragment nodes too
				results = context.getElementsByTagName( tag );

			// Filter out possible comments
			if ( tag === "*" ) {
				while ( (elem = results[i++]) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}

				return tmp;
			}
			return results;
		};

	// Class
	Expr.find["CLASS"] = support.getElementsByClassName && function( className, context ) {
		if ( documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};

	/* QSA/matchesSelector
	---------------------------------------------------------------------- */

	// QSA and matchesSelector support

	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];

	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See http://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];

	if ( (support.qsa = rnative.test( doc.querySelectorAll )) ) {
		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert(function( div ) {
			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// http://bugs.jquery.com/ticket/12359
			docElem.appendChild( div ).innerHTML = "<a id='" + expando + "'></a>" +
				"<select id='" + expando + "-\f]' msallowcapture=''>" +
				"<option selected=''></option></select>";

			// Support: IE8, Opera 11-12.16
			// Nothing should be selected when empty strings follow ^= or $= or *=
			// The test attribute must be unknown in Opera but "safe" for WinRT
			// http://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
			if ( div.querySelectorAll("[msallowcapture^='']").length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}

			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !div.querySelectorAll("[selected]").length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}

			// Support: Chrome<29, Android<4.2+, Safari<7.0+, iOS<7.0+, PhantomJS<1.9.7+
			if ( !div.querySelectorAll( "[id~=" + expando + "-]" ).length ) {
				rbuggyQSA.push("~=");
			}

			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":checked").length ) {
				rbuggyQSA.push(":checked");
			}

			// Support: Safari 8+, iOS 8+
			// https://bugs.webkit.org/show_bug.cgi?id=136851
			// In-page `selector#id sibing-combinator selector` fails
			if ( !div.querySelectorAll( "a#" + expando + "+*" ).length ) {
				rbuggyQSA.push(".#.+[+~]");
			}
		});

		assert(function( div ) {
			// Support: Windows 8 Native Apps
			// The type and name attributes are restricted during .innerHTML assignment
			var input = doc.createElement("input");
			input.setAttribute( "type", "hidden" );
			div.appendChild( input ).setAttribute( "name", "D" );

			// Support: IE8
			// Enforce case-sensitivity of name attribute
			if ( div.querySelectorAll("[name=d]").length ) {
				rbuggyQSA.push( "name" + whitespace + "*[*^$|!~]?=" );
			}

			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( !div.querySelectorAll(":enabled").length ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Opera 10-11 does not throw on post-comma invalid pseudos
			div.querySelectorAll("*,:x");
			rbuggyQSA.push(",.*:");
		});
	}

	if ( (support.matchesSelector = rnative.test( (matches = docElem.matches ||
		docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector) )) ) {

		assert(function( div ) {
			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( div, "div" );

			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( div, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		});
	}

	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join("|") );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join("|") );

	/* Contains
	---------------------------------------------------------------------- */
	hasCompare = rnative.test( docElem.compareDocumentPosition );

	// Element contains another
	// Purposefully does not implement inclusive descendent
	// As in, an element does not contain itself
	contains = hasCompare || rnative.test( docElem.contains ) ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			));
		} :
		function( a, b ) {
			if ( b ) {
				while ( (b = b.parentNode) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};

	/* Sorting
	---------------------------------------------------------------------- */

	// Document order sorting
	sortOrder = hasCompare ?
	function( a, b ) {

		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		// Sort on method existence if only one input has compareDocumentPosition
		var compare = !a.compareDocumentPosition - !b.compareDocumentPosition;
		if ( compare ) {
			return compare;
		}

		// Calculate position if both inputs belong to the same document
		compare = ( a.ownerDocument || a ) === ( b.ownerDocument || b ) ?
			a.compareDocumentPosition( b ) :

			// Otherwise we know they are disconnected
			1;

		// Disconnected nodes
		if ( compare & 1 ||
			(!support.sortDetached && b.compareDocumentPosition( a ) === compare) ) {

			// Choose the first element that is related to our preferred document
			if ( a === doc || a.ownerDocument === preferredDoc && contains(preferredDoc, a) ) {
				return -1;
			}
			if ( b === doc || b.ownerDocument === preferredDoc && contains(preferredDoc, b) ) {
				return 1;
			}

			// Maintain original order
			return sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;
		}

		return compare & 4 ? -1 : 1;
	} :
	function( a, b ) {
		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];

		// Parentless nodes are either documents or disconnected
		if ( !aup || !bup ) {
			return a === doc ? -1 :
				b === doc ? 1 :
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;

		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}

		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( (cur = cur.parentNode) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( (cur = cur.parentNode) ) {
			bp.unshift( cur );
		}

		// Walk down the tree looking for a discrepancy
		while ( ap[i] === bp[i] ) {
			i++;
		}

		return i ?
			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[i], bp[i] ) :

			// Otherwise nodes in our document sort first
			ap[i] === preferredDoc ? -1 :
			bp[i] === preferredDoc ? 1 :
			0;
	};

	return doc;
};

Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};

Sizzle.matchesSelector = function( elem, expr ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	// Make sure that attribute selectors are quoted
	expr = expr.replace( rattributeQuotes, "='$1']" );

	if ( support.matchesSelector && documentIsHTML &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {

		try {
			var ret = matches.call( elem, expr );

			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||
					// As well, disconnected nodes are said to be in a document
					// fragment in IE 9
					elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch (e) {}
	}

	return Sizzle( expr, document, null, [ elem ] ).length > 0;
};

Sizzle.contains = function( context, elem ) {
	// Set document vars if needed
	if ( ( context.ownerDocument || context ) !== document ) {
		setDocument( context );
	}
	return contains( context, elem );
};

Sizzle.attr = function( elem, name ) {
	// Set document vars if needed
	if ( ( elem.ownerDocument || elem ) !== document ) {
		setDocument( elem );
	}

	var fn = Expr.attrHandle[ name.toLowerCase() ],
		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;

	return val !== undefined ?
		val :
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			(val = elem.getAttributeNode(name)) && val.specified ?
				val.value :
				null;
};

Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};

/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;

	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );

	if ( hasDuplicate ) {
		while ( (elem = results[i++]) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}

	// Clear input after sorting to release objects
	// See https://github.com/jquery/sizzle/pull/225
	sortInput = null;

	return results;
};

/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;

	if ( !nodeType ) {
		// If no nodeType, this is expected to be an array
		while ( (node = elem[i++]) ) {
			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {
		// Use textContent for elements
		// innerText usage removed for consistency of new lines (jQuery #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {
			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}
	// Do not include comment or processing instruction nodes

	return ret;
};

Expr = Sizzle.selectors = {

	// Can be adjusted by the user
	cacheLength: 50,

	createPseudo: markFunction,

	match: matchExpr,

	attrHandle: {},

	find: {},

	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},

	preFilter: {
		"ATTR": function( match ) {
			match[1] = match[1].replace( runescape, funescape );

			// Move the given value to match[3] whether quoted or unquoted
			match[3] = ( match[3] || match[4] || match[5] || "" ).replace( runescape, funescape );

			if ( match[2] === "~=" ) {
				match[3] = " " + match[3] + " ";
			}

			return match.slice( 0, 4 );
		},

		"CHILD": function( match ) {
			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[1] = match[1].toLowerCase();

			if ( match[1].slice( 0, 3 ) === "nth" ) {
				// nth-* requires argument
				if ( !match[3] ) {
					Sizzle.error( match[0] );
				}

				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[4] = +( match[4] ? match[5] + (match[6] || 1) : 2 * ( match[3] === "even" || match[3] === "odd" ) );
				match[5] = +( ( match[7] + match[8] ) || match[3] === "odd" );

			// other types prohibit arguments
			} else if ( match[3] ) {
				Sizzle.error( match[0] );
			}

			return match;
		},

		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[6] && match[2];

			if ( matchExpr["CHILD"].test( match[0] ) ) {
				return null;
			}

			// Accept quoted arguments as-is
			if ( match[3] ) {
				match[2] = match[4] || match[5] || "";

			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&
				// Get excess from tokenize (recursively)
				(excess = tokenize( unquoted, true )) &&
				// advance to the next closing parenthesis
				(excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length) ) {

				// excess is a negative index
				match[0] = match[0].slice( 0, excess );
				match[2] = unquoted.slice( 0, excess );
			}

			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},

	filter: {

		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() { return true; } :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},

		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];

			return pattern ||
				(pattern = new RegExp( "(^|" + whitespace + ")" + className + "(" + whitespace + "|$)" )) &&
				classCache( className, function( elem ) {
					return pattern.test( typeof elem.className === "string" && elem.className || typeof elem.getAttribute !== "undefined" && elem.getAttribute("class") || "" );
				});
		},

		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );

				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}

				result += "";

				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result.replace( rwhitespace, " " ) + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
			};
		},

		"CHILD": function( type, what, argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";

			return first === 1 && last === 0 ?

				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :

				function( elem, context, xml ) {
					var cache, outerCache, node, diff, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType;

					if ( parent ) {

						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( (node = node[ dir ]) ) {
									if ( ofType ? node.nodeName.toLowerCase() === name : node.nodeType === 1 ) {
										return false;
									}
								}
								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}

						start = [ forward ? parent.firstChild : parent.lastChild ];

						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {
							// Seek `elem` from a previously-cached index
							outerCache = parent[ expando ] || (parent[ expando ] = {});
							cache = outerCache[ type ] || [];
							nodeIndex = cache[0] === dirruns && cache[1];
							diff = cache[0] === dirruns && cache[2];
							node = nodeIndex && parent.childNodes[ nodeIndex ];

							while ( (node = ++nodeIndex && node && node[ dir ] ||

								// Fallback to seeking `elem` from the start
								(diff = nodeIndex = 0) || start.pop()) ) {

								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									outerCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}

						// Use previously-cached element index if available
						} else if ( useCache && (cache = (elem[ expando ] || (elem[ expando ] = {}))[ type ]) && cache[0] === dirruns ) {
							diff = cache[1];

						// xml :nth-child(...) or :nth-last-child(...) or :nth(-last)?-of-type(...)
						} else {
							// Use the same loop as above to seek `elem` from the start
							while ( (node = ++nodeIndex && node && node[ dir ] ||
								(diff = nodeIndex = 0) || start.pop()) ) {

								if ( ( ofType ? node.nodeName.toLowerCase() === name : node.nodeType === 1 ) && ++diff ) {
									// Cache the index of each encountered element
									if ( useCache ) {
										(node[ expando ] || (node[ expando ] = {}))[ type ] = [ dirruns, diff ];
									}

									if ( node === elem ) {
										break;
									}
								}
							}
						}

						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},

		"PSEUDO": function( pseudo, argument ) {
			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );

			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}

			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction(function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf( seed, matched[i] );
							seed[ idx ] = !( matches[ idx ] = matched[i] );
						}
					}) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}

			return fn;
		}
	},

	pseudos: {
		// Potentially complex pseudos
		"not": markFunction(function( selector ) {
			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );

			return matcher[ expando ] ?
				markFunction(function( seed, matches, context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;

					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( (elem = unmatched[i]) ) {
							seed[i] = !(matches[i] = elem);
						}
					}
				}) :
				function( elem, context, xml ) {
					input[0] = elem;
					matcher( input, null, xml, results );
					// Don't keep the element (issue #299)
					input[0] = null;
					return !results.pop();
				};
		}),

		"has": markFunction(function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		}),

		"contains": markFunction(function( text ) {
			text = text.replace( runescape, funescape );
			return function( elem ) {
				return ( elem.textContent || elem.innerText || getText( elem ) ).indexOf( text ) > -1;
			};
		}),

		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {
			// lang value must be a valid identifier
			if ( !ridentifier.test(lang || "") ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( (elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute("xml:lang") || elem.getAttribute("lang")) ) {

						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( (elem = elem.parentNode) && elem.nodeType === 1 );
				return false;
			};
		}),

		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},

		"root": function( elem ) {
			return elem === docElem;
		},

		"focus": function( elem ) {
			return elem === document.activeElement && (!document.hasFocus || document.hasFocus()) && !!(elem.type || elem.href || ~elem.tabIndex);
		},

		// Boolean properties
		"enabled": function( elem ) {
			return elem.disabled === false;
		},

		"disabled": function( elem ) {
			return elem.disabled === true;
		},

		"checked"led": function( elem ) {// Inc CSS3,:checked should return soth ihecked snd telected olements
		/// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			/ar nodeName = nlem.nodeName.toLowerCase(),
			return h(odeName = = "input" && e!elem.phecked
)|| (node[ame = = "iption  && e!elem.pelected ;
		},

		"Aelected led": function( elem ) {// IAcessing "his iroperty smakestelected -by-efault
		i// ortion  in oafari 8ork oroperty
			if ( !lem.parentNode)) {
				vlem.parentNode)pelected ndex)
			}

			return flem.pelected === true;
		},

		"/ Contexts
		/"mpty led": function( elem ) {// Ittp://www.w3.org/TR/selectors/#lmpty pseudo
		"// :(mpty ss nogatid by "lement (i1 or :ontent aodes a(ext : 3; cata : 4;entrty ief : 5)
			// s but "ot hy "thers
 (omment : 8;processing instruction : 7;entc.
			// IodeType =< 6works secause ottributes |(2)do not sppearsas coildren
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				rf ( elem.nodeType =< 6w {
					return !alse;
					
			}
			return frue;
		},

		"carentN: function( elem ) {
			return e!xpr.pseudos[ "mpty l] elem );
			,

		"/ Clement /nput types
 	"haadier: function( elem ) {
			return eraadiertest( exem.nodeName &;
		},

		"Anput"  function( elem ) {
			return ernputs test( exem.nodeName &;
		},

		"Autton") function( elem ) {
			var hame = elem.nodeName.toLowerCase();
		rreturn name === "input" && elem.type === tAutton")|| name === "button")
		},

		"Aext ) function( elem ) {
			var httri;			return flem.podeName.toLowerCase() === ninput" && 				vlem.pype === tAext )&& 	
			// Dupport: IE<8
	/		// DNew TML 5attribute salue  |(e.g., Aelarch) |ppearsaith tlem.pype === tAext )	/		/ (ettr = flem.getAttribute("lype";))== null )| a.tritoLowerCase() === niext )&;
			,

		"/ Cosition(ins-olliction
			"irstC) freatePositionalPseudo( unction() { 			return f[ 0];
		}
,

		"cast", freatePositionalPseudo( unction()matchIndexes[, ength ) {
				eturn f[ ength - e1];
		}
,

		"ceq, freatePositionalPseudo( unction()matchIndexes[, ength  argument ) {
			/eturn f[ rgument )<0 ?
 rgument )+ ength -:argument ];
			
,

		"ceen"  freatePositionalPseudo( unction()matchIndexes[, ength ) {
				ar in  0;
				or ( e;in < ength ;in += 2) {
				match[ndexes.lush( i );
			}
		}return matchendexes.
			
,

		"cdd"  freatePositionalPseudo( unction()matchIndexes[, ength ) {
				ar in  01
				or ( e;in < ength ;in += 2) {
				match[ndexes.lush( i );
			}
		}return matchendexes.
			
,

		"cl", freatePositionalPseudo( unction()matchIndexes[, ength  argument ) {
			/ar in  0rgument )<0 ?
 rgument )+ ength -:argument 
				or ( e;i--i>= 0 ;) {
				match[ndexes.lush( i );
			}
		}return matchendexes.
			
,

		"cg", freatePositionalPseudo( unction()matchIndexes[, ength  argument ) {
			/ar in  0rgument )<0 ?
 rgument )+ ength -:argument 
				or ( e;i++n < ength ;i {
				match[ndexes.lush( i );
			}
		}return matchendexes.
			
,	}
}


Expr pseudos[ "th",]= Expr.pseudos[ ceq,;

	/ IAddbuttons/nput typespseudos
	or ( eiin o{ radio true  check.box true  cfie: {rue  casseorkd {rue  cimage true },i {
		xpr.pseudos[ pi] = mreateInputPseudo( t );
	}	or ( eiin o{ submit {rue  cesent true },i {
		xpr.pseudos[ pi] = mreateIuttonPseudo( t );
	}	// Exasy APIfor coeating lew RetFilters.function sitFilters.( {}
	etFilters.hrototype p=Expr.filter.s= Expr.pseudos[;
xpr.setFilters.= new RitFilters.( 

	okenize ( Sizzle.aokenize ( Sunction( selector  pareseOly c {
	var natched[ matche,tokeni[, ype, 
	sorFar greoup[, reFilter:,
			ached e tokeniache[ telector ) " " ];

		f ( coched e {
		return eareseOly c?0 :
coched slice( 0 );
	r

		orFar= seeector 
	rreoup[  [];

preFilter:s= Expr.pseFilter:

	while ( iorFar= {

		// FCmma ind filst >ru
			f ( !match[d e| (nmtch = mromma .xesc iorFar=  ) {
			if ( eatch ) {
			v// Don't konsime thailing
commea as calid 			v/orFar= serFarslice( 0atch[0].sength ) {| strFar
			}
		}rreoup[lush( i(okeni[  [];));
		}

		/atched = fnlse;
			// FCmminators
			f ( (emtch = mromminators
.xesc iorFar=  ) {
			iatched = matche.hift( ;
			}okeni[lush( 
				varue :natched[ 			v// DCst =escendeat conminators
to seaces			v/ype,:0atch[0].seplace( rtrim, "$" ).			}
;
			}orFar= serFarslice( 0atch[d.length -;
		}

		// Wilters.f		or ( eype pinExpr.filter.) {
			if ( eemtch = matchExpr["type ] .xesc iorFar=  )& (!dreFilter:s type ] || 	/		/ mtch = mreFilter:s type ]  eatch )   ) {
			iiatched = matche.hift( ;
			}}okeni[lush( 
				vvarue :natched[ 			v//ype,:0ype, 
	s	iiatcheds:natche					
;
			}}orFar= serFarslice( 0atch[d.length -;
		}}
		}
				f ( !match[d e {
			bpeak;
			
	}

	// Ceturn ohe eength -f theiinvalid pxcess 	// Cf we 'rejust aaresng
		/ Otherwise ,throw on error
 r returnstokeni[
return eareseOly c?
	sorFarlength -:
	sorFar?
				izzle.error( "elector ) {:
	v// DCshe the iokeni[
r}}okeniache( celector  preoup[ )slice( 0 );
	


Eunction to elector(:iokeni[c {
	var n = 0,
		nenge tokeni.length  
	solector =="";

	or ( e;in < eng;in++  {
		setector )  tokeni.[i]value ;	}
	return ceeector 
	}
Eunction taddCmminators 0atch[d, chmminators,basedc {
	var nir = thmminators.ir 
			aeck.NonEements u=basedc& dif === "|arentNode", 
	do nName = no nN+;
		return conminators.ilst >?
	// Check tgainst cylosst atcestor
/reFceing alement
			unction( elem, context, xml ) {
				hile ( (elem = elem. dir ]) ) {
					f ( elem.nodeType === 1 )| coeck.NonEements u {
					return !atcher( ilem, context, xml ) 
					
			}
			 :

			/ Check tgainst cll ttcestor
/reFceing alement
s			unction( elem, context, xml ) {
				ar noldCche, outerCache, 					ew ache = p dirruns, di nName =]

			// TW can ' setFargbitary/data on `ML nodes
 so ahey aon't hbenefitfrom pir ]ocheng
			/f ( eml ) {
					hile ( (elem = elem. dir ]) ) {
						f ( elem.nodeType === 1 )| coeck.NonEements u {
					rif ( eatch r( ilem, context, xml ) ) {
							seturn true;
						}

				}

				
			}
else {
					hile ( (elem = elem. dir ]) ) {
						f ( elem.nodeType === 1 )| coeck.NonEements u {
					riuterCache = plem[ expando ] || (elem[ expando ] = {}));					rif ( e(oldCche,= outerCache[ tir ]) )& 				v	riuldCche,[ 0];=== dirruns && culdCche,[ 1];=== di nName = {

								/ As ign oo sew ache =soresults )ack -ropeagte thopreviouslolements
		//			seturn t(ew ache [ 2) = {uldCche,[ 2) ;
						}
else {
							// URese oew cche =soresults )ack -ropeagte thopreviouslolements
		//			suterCache[ tir ])= new ache[;
								/ Aseatch )mans +e 'reji nN;a fiil wmans +e have to beep toeck.ng
			/		rif ( e(ew ache [ 2) = {atch r( ilem, context, xml )  ) {
									eturn true;
						}}
						}

				}

				
			}

	};
	}
Eunction tlementsMtch r( iatch r( ) {
	return Satch r( length > 1 )?			unction( elem, context, xml ) {
				ar n = matched( length ;				hile ( (-- ) {
					f ( !match[dr.[i] ilem, context, xml ) ) {
						eturn !alse;
					
			}
			return frue;
		},{:
	vatch[dr.[0]
	}
Eunction tmltsipleCntext,s celector  pontext,s,results ) {
	var e = 0,
		nenge tontext,slength ;		or ( e;in < eng;in++  {
		sizzle( selector, eontext,si], besults );
		}	return results;
};
Eunction tontdni.( unqatched[ matp,filter  context, xml ) {
		ar elem,
			ew Umatched = m],
			 = 0,
		nenge tnqatched[length  
	smppea = matp ! null;

	ror ( e;in < eng;in++  {
		sf ( (elem = unmatched[i]) ) {
				f ( !milter.)| (ilter. ilem, context, xml ) ) {
					ew Umatched push( elem );
					f ( eatpea = {
						atplush( i );
			}	
			}

	};	}

	return Sew Umatched 
};
Eunction tetFMtch r( ireFilter:,selector, eatch[d, cost-ilter:,sost-iltdn:,sost-elector ) {
		f ( past-ilter:&& e!ast-ilter: expando ] ) {
			ast-ilter:&=tetFMtch r( irst-ilter:&;
		}	rf ( past-iltdn:&& e!ast-iltdn: expando ] ) {
			ast-ilndr:&=tetFMtch r( irst-iltdn:,sost-elector ) 
		}	return rarkFunction(function( seed, mesults; context, xml ) {
			ar etemp,fi,elem,
				reFMa = [],
				ost-Ma = [],
				orexisteig = eesults.pength  
			// Tet einiiallelements urom peed,or :ontenx
		i/lemes= seed.|| maltsipleCntext,s celector || ""*" context,nodeType = [ montext ) : [ontext, x] ),
				// TPreilter.)o bet fatcher =nput, nresenrvng a batp fr seled-esults )syncrownizaion
			/atcher In= mreFilter:)& (!seed.|| m!elector ) {
					ontdni.( ulemes nresMtp,freFilter:,sontext, xml ) {
					lemes 
			/atcher Ou = matchesr?
				// If ne have tairst-iltdn:,sr )ilter.d shed, mornon-xeed.|rst-ilter:&r proexisteig =esults; 				/ast-ilndr:&| ( deed.|?mreFilter:):proexisteig =| (rst-ilter:&;?

				/// I...itereediatelprocessing in nogessiry/				//] ):
				/// I...oherwise nse oesults )irectily						etults ):			iiatched In;
		// Wiln.|rrimry/datcheds
rif ( eatch r() {
			iatched( iatch r(In eatch[d,Ot, nontext, xml ) 
			

		// WAppy crst-ilter:
rif ( erst-ilter:&;?
			itempe tontdni.( uatch[d,Ot, nost-Ma =;
			}rst-ilter:(etemp,f],
nontext, xml ) 
				// TUn-atch )filing
clements ub/daoing the m ack to satch r(In				f= texmplength ;				hile ( (-- ) {
					f ( !elem = uexmpi]) ) {
						atch[d,Ot,[nost-Ma i] = = !(matches(In[nost-Ma i] = = !eem);
					
			}

	};	
rif ( eeed.| {
				f ( !ast-ilndr:&| (reFilter:) {
					f ( !ast-ilndr:& {
						/ Tet ehe filal oatcher Ou =y cantdni.ng "his iitereediatelpiteo!ast-ilndr:&ontext,s			v//yep = [],
						 = matched(Ou length;
						hile ( i-- ) {
						if ( (elem = uatch[d,Ot,[]) ) {
							s/ URetoressatch r(Insince ilem =s not ret dafilal oatche							sexmplush( i(atches(In[] = elem););
						}
					})					}ast-ilndr:(null, x(atcher Ou = m[]),etemp,fml ) 
					
					// Iove tatched =lements urom peed,otoresults )o beep the m syncrownizd
			/	 = matched(Ou length;
					hile ( i-- ) {
						f ( (elem = uatch[d,Ot,[]) )& 				v	r(yep = [ast-ilndr:&?indexOf( seed, mlem ) {:nresMtp[]) ) -1 : {

							eed[iyep  = !(mesults[ yep  = !eem);
					}

				
			}

		// WAd =lements utoresults ,through Qast-ilndr:&f (efined"
	}
else {
				atcher Ou = montdni.( 			iiatched Ou = = results[?
					marched(Ou lplice( droexisteig ,matched(Ou length;) {
					marched(Ou 				;
			in ( !ast-ilndr:& {
					ast-ilndr:(null, xesults ,tatch[d,Ot, nml ) 
				
else {
					ush(appely(xesults ,tatch[d,Ot,);
			}
		}
	} )
	}
Eunction tmtch[d,Fom Tkeni.:iokeni[c {
	var noeck.Cntext, xatch[d, cj
		nenge tokeni.length  
	seading Rlative:= Expr.pelative:[tokeni.[0]pype =,
			 mlicitlRlative:= Eeading Rlative:=| Expr.selative:[" ",
			 = 0eading Rlative:= 1 :
 0

		"/ Che iound,aionalPeatch r()ni.res nhat slements ure rescheble &rom tokp-level&ontext,(s)
	vatch[Cntext,  0rddCmminators 0unction( elem ) {
			return elem === doeck.Cntext,
			,
  mlicitlRlative: true )),
	vatch[AnyCntext,  0rddCmminators 0unction( elem ) {
			return endexOf( check Cntext, xlem ) { -1;
			,
  mlicitlRlative: true )),
	vatch[r:s= E[function( elem, nontext, xml ) {
				ar net = " !meading Rlative:=& (!sml )| context )== futerCmst-Cntext, )) {| s 			ii(heck Cntext,e tontext,)nodeType = 					marcheCntext, elem, nontext, xml ) {
					marcheAnyCntext, ilem, context, xml ) ) ;			// TAoid thangng on o emement (issue #299)
				heck Cntext,e tull;
				eturn ret;
			}=]

		or ( e;in < eng;in++  {
		sf ( (eatcher = cxpr.pelative:[tokeni.[i]pype =, ) {
			iatched:s= E[frddCmminators lementsMtch r( iatch r( )  xatch[d,)];
			
else {
				atcher p=Expr.filter.[tokeni.[i]pype =,appely(xull, xokeni.[i]patches ) 
				// Teturn opeciflPeupn teteng a bpsitionalPxatch[d,			in ( !atcher[ expando ] ? {
			v// Diln.|he next celative:operator =if wany) fr sropertthanding
			/j = d++i
					or ( e;ij < eng;ij++  {
		s		in ( !xpr.pelative:[tokeni.[j]pype =,) {
							reak;
						

				
			}return ceesMtch r( 						 =>1 && +lementsMtch r( iatch r( )  						 =>1 && +o elector(:
					s/ Uf the nreFceing aokeni wa as=escendeat conminators,inster atc  mlicitlwany-mement (`*
						iokeni.llice( 0, 3i- e1])contcat({ arue :nokeni.[3i- e2 ]pype === tA  ? r*" ?:"" )}
					i)replace( rtrim, "$1" )  
	s	iiatchedr 						 =<ij & match[d,Fom Tkeni.:iokeni[llice( 0i cj) )  						j < eng & match[d,Fom Tkeni.:i(okeni[  [okeni[llice( 0j)  )  						j < eng & mo elector(:iokeni[c 					;
			}
		}ratched( lush( iatch r() 
			
	}

	/eturn elem ntsMtch r( iatch r( ) 
	}
Eunction tmtch[d,Fom GeoupMtch r(s(elem ntsMtch r(
 soesMtch r([c {
	var nbySt = "oesMtch r([length > 0; 			bylement &=elem ntsMtch r(
length > 0; 			suertMtcher p=Eunction( seed, montext, xml  xesults ,tuterCmst-) {
				ar nlem, cj xatch[d, 			iiatcheddCmut &=e,
			a	 = 0"0"
				unqatched = meed,o& m],
				moesMtch r = m],
					ontext,Bck p = buterCmst-Cntext, 			v// DW must balway have aither deed,olements ur
 rterCmst-)ontenx
		i//lemes= seed.|| mbylement && mxpr.filnd[TAG":](""*" cuterCmst-)  			v// DUe instegerdirruns &ff /his is ehe ofterCmst-)atch[d,			i	irruns UiqueS= " irruns &+ tontext,Bck p =  null ) 1 :
 Mtch.rndo m( {| s0.1  			v/enge tlemeslength;

				f ( ofterCmst-) {
					uterCmst-Cntext, =context )== focument && ecntext,
			}

			// Acd =lements uasseng
clementsMtch r([cirectilyutoresults 			// AKep t`i`a siring"if the e ade neo=lements uso`matcherdCmut `will nbe0"00"belonw			// Aupport: IE<89,oafari 			// AToleate tode"Lit aaoperties (jIE:""ength;";oafari : <nuber >)matching olements ub/dd 			vor ( e;in == feng & melem = elem.s[]) )! null;
in++  {
		s	if ( b ylement && mlem ) {
			r	j = 0,
						hile ( ieatcher = clementsMtch r([[j+]) ) {
			/		in ( !atcher[ ilem, context, xml ) ) {
							setults.posh( elem );
								reak;
						}
					})					}f ( ofterCmst-) {
					i	irruns   dirruns UiqueS
						

				
				v// DTrck tnqatched =lements urr selt)ilter.s		s	if ( b ySt = {
						/ TTey aill nave agne shrough Qll tossible tatch r( 						f ( (elem = umatch[dr&& mlem  ) {
							atcherdCmut --
						

						/ Tength:e ohe erray oor elvry #lements matched[mornont						f ( (eed.| {
						unqatched posh( elem );
						

				
			}

		/// WAppy celt)ilter.sutornqatched =lements 
			atcherdCmut &+ ti
			in ( ! ySt =& mn == fatcherdCmut & {
					 = 0,
					hile ( ieatcher = coesMtch r([[j+]) ) {
			/		atcher[ inqatched[ moesMtch r  context, xml ) 
					
	
				f ( (eed.| {
						/ Tetnstegate tmement (atches )o emeimnatoe|he nexd for corting
	s/		in ( !atcherdCmut &>0 );{
						uhile ( i-- ) {
							id ( !m(nmatched[i]){| stesMtch r []) ) {
							s	tesMtch r [])= [aspcall( Eesults );
					/}}
						}

				}

						/ Tiscord &ndex olace(holdr:&alue  |o bet fnly cactulPxatch[d 						oesMtch r = montdni.( uoesMtch r = 
					
					// Icd =atches )o eesults 			/	ush(appely(xesults ,toesMtch r = 
					// ISxd ess wse (atches )succeeing aaltsiple)successfuliatch r( )ssiplate porting
	s/		f ( ofterCmst-)& !sted,o& moesMtch r length > 0;)& 				v	 !atcherdCmut &+"oesMtch r([length >)> 1 ) {
					v	izzle.uniqueSort  Eesults );
					
			}

		/// WOvryiden!atniplateon tof global ub/dneted batch r( 				f ( ofterCmst-) {
					irruns   dirruns UiqueS
					uterCmst-Cntext, =context Bck p 
			}

			/eturn eumatched 
}	};

	return d ySt =?
	markFunction(f suertMtcher p):
		supprtMtcher 
	}
Eompile(( Sizzle.aompile(( Sunction( selector  patch )/* IterealPxUe iOly c*/) {
	var e  
	solsMtch r([c m],
			lementsMtch r([c m],
			ached e tompile(rache[ telector ) " " ];

		f ( c!oched e {
		r/ Tetneate tafunction fof ecursivelfunction  nhat scn be aued to coeck tach enement
			f ( !match[) {
			iatche  tokenize( uelector ) 
			
	}	 = matchelength;
			hile ( i-- ) {
				ached e tatch[d,Fom Tkeni.:iatch[i] );
				f ( coched  expando ] ? {
			v/oesMtch r([losh( eoched e 
				
else {
					lem ntsMtch r(
losh( eoched e 
				

	}

		// WCshe the iompile(dfunction
			ached e tompile(rache[ selector  patch d,Fom GeoupMtch r(s(elem ntsMtch r(
 soesMtch r([c {);
		// WSve aelector )nd trkenizeaion
			ached .olector =="eeector 
	r
	return coahed 
};

/**
 * UA onw-level&eeectoon fonction toat sorks sith tizzle.'siompile(d * Uaelector )unction   * @param {ASring"|unction(}aelector )Aaelector )r a dpre-ompile(d * Uaelector )unction  bultesith tizzle.aompile( * @param {Alement })ontenx
	* @param {Array|} [esults ]	* @param {Array|} [ted,])Aael of xlements utoratche gainst  */
gelecto  Sizzle.selecto( Sunction( selector  pontext, xesults ,toed e {
		ar e  tokeni[, ykeni, ype, fila[ 			ompile(df=typeof eolector === tAunction("o& moeector  
	iatche  tsted,o& mokenize( u(olector =="ompile(d.elector || "elector  {);
		esults = [esults =| [];
	
// DTryutormnaimnz:operatoon  in the e as nottoed end tnly cne sreoup
in ( !atchelength >== 1 ) {
			// WTke sashoutcut fnd teltthe iomtext, f the noot"eolector =s a n I
			okeni[  [atch[i] = match[0].slice( 0,e 
			f ( tykeni.length > 12 & meokeni =tokeni.[0])pype === tAID && 				vupport.set ById&& ecntext,nodeType === 19&& documentIsHTML &&
		(		xpr.pelative:[tokeni.[1]pype =,) {
					antext, =c(mxpr.filnd[TID ] tykenipatches 0].seplace( unescape, funescape ) pontext,) {| s] ),[0]
			id ( !montext,) {{			}return cesults;
}		/// WPecogpile(dfatch r( )ill nssil nvryifyttcestory so atedp upsaslevel				
else {f ( cogpile(df {{			}rcntext, =context parentNode;
				

			/olector =="eeector slice( 0okeni[llift( ;value length -;
		}

		// Wieche gtoed eelt)ir reight-to-leftmatching 	}	 = matchexpr["Cexd sCntext,].test( melector ) {
0 :
cykeni.length 
			hile ( i-- ) {
				okeni =tokeni.[i]

			// TAbrt ff we hatlwaconminators			id ( !xpr.pelative:[t(ype p=Eykenipype)
] ? {
			v/reak;
				}			id ( !(ilndp=Expr.filnd[ ype =, ) {
			i// ISxarch,expandong
comtext, ir reading aibling chmbinators
			vid ( !(oed e=fila[:
					ykenipatches 0].seplace( runescape, funescape ). 						ribling test( tykeni.[0]pype = )& (est(Cntext, iontext parentNode;) {| sontenx
		i//) ) {

						/ Uf toed es expty sornoniokeni[creaint,we can deturn elarly						okeni[llpice( 0i c );
				r/olector =="eer length >& mo elector(:iokeni[c 
						  ( !melector ) {
			r	/	ush(appely(xesults ,toer = 
					}return cesults;
}				}

						reak;
					
			}

	};	}

	r/ FCmmile((nd txescue tafulter.ng cunction    (ne ss not rprovied
	i/ WPeovied`matche`to avoid tetukenizeaion
ff we hmodfied ?he selector pbove 
	 cogpile(df| sonpile( selector. patch ) ) (
		eed[ 			omtext, 			documentIsHTML 
		retults; 			ribling test( telector ) {& (est(Cntext, iontext parentNode;) {| sontenx
		;
	resurn results;
};

/* WOne-timeassuignents 
/* Wort =stablity 
upport.sortStable &=expando llpict("")sort( sortOrder );.join("")=== elpando 

/* Wupport: IChom e 14-35+	/ IAlway hssume tuplicates =f the  argn't yassed to che iompiarisn fonction 
upport.detectDuplicates;  ts!asDuplicate 

/* WIniiallnz:ogainst the eefault
document
	etDocument( )

/* Wupport: IWebkit<537.32 -oafari 86.0.3/Chom e 25!(ilxd indIChom e 27)/* WDetched eodes aontound,ng y followe *ach eoherw*
upport.sortSDetched e=hssuet( unction( sdiv ) {
		/ Shorld return s1,but "eturn s 4!(illoweng )	resurn rdiv .ompiareocument(ositiona(document.hreateIlement ("div) ) {&01
	})

/* Wupport: IE<8
	/ WPecvnt (ttribute /roperty s"iterepoateon "
/ Ittp://wmsdipaicrosoftcom/jen-us/libary/wms536429%28VS.85%29.aspx
  ( !mssuet( unction( sdiv) {
		divinnerTTML & tA<a ref ='#'></a>";	resurn rdivfirstChild;getAttribute("lref ")=== e"#" 
	})) {
		addandle:( lype"|ref |height|widh",
function( elem, name ,ss XL ) :
		sf ( (!s XL ) :
		sreturn flem.petAttribute( name  name.toLowerCase() )== niepe";) 1 :
 2) 
			
	}
;
	}	// Eupport: IE<89
/ DUe iefault
Vlue isnolace(tof gtAttribute("lalue ")
  ( !mupport.attributes || !dssuet( unction( sdiv) {
		divinnerTTML & tA<nput,/>";	rdivfirstChild;gstAttribute( nlalue ","" );
		esurn rdivfirstChild;getAttribute("nlalue "  )== ni"
	})) {
		addandle:( lalue ","unction( elem, name ,ss XL ) :
		sf ( (!s XL )& elem.nodeName.toLowerCase() === ninput" & {
			return elem.difault
Vlue 
			
	}
;
	}	// Eupport: IE<89
/ DUe ietAttribute(ode;)o cfeche bolean swhetnietAttribute( les
	  ( !mssuet( unction( sdiv) {
		esurn rdivfgtAttribute("lisabled":)== null 
	})) {
		addandle:( bolean s,"unction( elem, name ,ss XL ) :
		sar ealu;		sf ( (!s XL ) :
		sreturn flem.[name =]=== true;? nome.toLowerCase() =
					m(alu  flem.getAttribute(ode;(name ); {& (alu.pecified ? 					malu.alue m
					ull;
			
	}
;
	}	/eturn Sizzle(

/})(window.{);
	

Query .ilndp=Eizzle(

Query .epr = Sizzle.selectors 

Query .epr [":,]= EQuery .epr pseudos[;
Query .uiqueS= "izzle.uniqueSort ;
Query .txt = Sizzle.getText ;
Query .s XL ocu= Sizzle.gs XL ;
Query .ontains"( Sizzle.aomtains";
	

ar neexd sCntext,= EQuery .epr patchelexd sCntext,;

ar neeng
leTa = e(/^<(\w+)\s*\/?>(?:<\/\1>|)$/);
	

ar neisSmple = t/^.[^:#\[\.,]*$/

/* WIple ent (he identifclu unction(aity fur )ilter.(nd tont	unction  indnow(elem ntss,"ual fier.,not r {
		f ( pQuery .s unction(f ual fier.) ) {
			eturn SQuery .gepl(elem ntss,"unction( elem, ni) :
		sr/* jlift (-W018 /
			meturn !!eual fier.call( Elem, ni xlem ) {!= nod;
			});
		}
		f ( cual fier.codeType ) {
		/eturn SQuery .gepl(elem ntss,"unction( elem,) :
		sreturn f elem = = nual fier.) )!= nod;
			});
		}
		f ( cypeof eual fier.)== "string" ) {
			f ( reisSmple test( tual fier.) ) {
			/eturn SQuery .ilter. iual fier.,nlem ntss,"ot r 
		}

		/ual fier.)=SQuery .ilter. iual fier.,nlem ntss);
	r

		eturn SQuery .gepl(elem ntss,"unction( elem,) :
		seturn f eQuery .snrray| Elem, nual fier.) )= 0 );)!= nod;
		
;
	}	/Query .ilter.( Sunction( sepr ,ulemes not r {
		ar nlem,= elem.s[ 0];
	
if ( nod,) {{			epr = S":od," + wepr = ")" ;	}

	/eturn elem slength >== 1 )& elem.nodeType === 1 ) 			Query .ilndpatches elector(:ilem, nepr =)= [ mlem,= : [] ):
		Query .ilndpatches  sepr ,uQuery .gepl(elem s,"unction( elem,) :
		sreturn flem.nodeType === 1 
			});
	


EQuery .in.eptend 
		ind: {unction( selector ) {
			ar e  
	s	et = "],
				ele = nhis 
				enge tele length;

			f ( cypeof eelector )!= "string" ) {
			return fris losh(tabck eQuery  selector ) .ilter. unction() { 			r	or ( eii 0 ;)n < eng;in++  {
		s			  ( !Query .ontains" selef pi] ,/his i ) {
							eturn true;
						

				
			}
));
		}

		/or ( eii 0 ;)n < eng;in++  {
		s	Query .ilnd selector. pelef pi] ,/et =;
		}

		// WNeded bycause o$ selector  pontext,  {bcogps |$(pontext,  .ilnd selector.c 			et = "ris losh(tabck eenge 1 )? Query .uiqueS(/et =;: [et =;
		}et .olector =="ris lolector =?"ris lolector =+" " + rolector =:"eeector 
	r	eturn ret;
		},	filter: {unction( selector ) {
			eturn fris losh(tabck eindnow(his 
celector || "],
nalse;));
		},	fod, {unction( selector ) {
			eturn fris losh(tabck eindnow(his 
celector || "],
nrue;));
		},	fis {unction( selector ) {
			eturn f!!indnow(				ois 
	
		s/ Uf thei is a npsitionalP/elative:oelector  poeck tember lifpisnohe noturn d eelt
		s/ Uso|$("p:irstC)).s ("p:ast",) wn't heturn true;fur )adocuwith thwo "p.
		/	ypeof eolector === tAtring" && eeexd sCntext,test( melector ) {

				Query  selector ) m
					elector || "],
				alse;
	i)rength 
		}	})

//* WIniiallnz:og Query  objcto
//* WA cntsrlu ef erece to the noot"eQuery  ocument.)
ar neot"Query ,
	r/ Fse the scorectifocument &accor,ng y fith tindow.{rgument )(snd box 		ocument & window.locument ,
	r/ FAsimple )wayto coeck tur )TML &tring"s
// Prioritize b#id ovr.(<tag>to avoid tXSS via ocation.hash; (#9521)
// StriptifTML &ecoggntiona (#11290:must btart =ith t<)	requickEpr = S/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,
	rinii)=SQuery .in.inii)=Sunction( selector  pontext,) {
			ar eatche,uleme;
		// WHANDLE:|$(""),|$(ull;),|$(ndefined"),|$(alse;)
		  ( !melector ) {
			return fris 
		}

		// Wandle:)TML &tring"s
/	f ( cypeof eelector )== "string" ) {
				f ( (eeector scharAt(0 === ni<"o& moeector scharAt(moeector sength - e1] === ni>"o& moeector sength > =3 ) !
			i// IAsume that sering"sthat serar fnd tend=ith t<>ade nTML &nd tekipohe notgexcoeck 			i/atche  t[xull, xelector  pull )]

			/
else {
					atche  tequickEpr .xesc iolector ) 
			}

		/// WMtch  htmlsornmake .resnoniomtext, fs pecified ?ur )#d 			vf ( eatch )& meatch[01){| smontext, ) {

					/ WHANDLE:|$(html) ->|$(rray )			vid ( !atch[01){ {
						cntext, =context instrtcesf eQuery  ?context i] = [ontext,

					// Mscript is ehue;fur )ack -ompiat						/ Uftent onalPy flltthe irror
 b shrouw
ff wareseTML &s not rprsente						Query .merg( 0ois 
cQuery .areseTML :
					satch[01)
						iontext i& ecntext,nodeType =?context .uw
erocument()| context ): ocument ,
					ihue;
					 );

			r		/ WHANDLE:|$(html,aaopes
					in ( reeng
leTa test( match[01){ {& eQuery .s PlinsObjcto(pontext,  ) {
							or ( eatch )inpontext,) {
					r		/ WPoperties (f eontext,)re casle(dfastemthod =f tossible 					r		f ( pQuery .s unction(f ois [eatch )]) ) {
							s	ois [eatch )](pontext,[eatch )]) ;
								/ A...nd tnherwise netFarsottributes 								
else {
							/	ois attr( eatche,uontext,[eatch )]) ;
							

						

					

						eturn fris 
						/ WHANDLE:|$(#d 
					
else {
						lem,= eocument.hgetlement ById match[02]);

			r		/ WCeck tarentNode;)o cotch )hetniBlck er y  4.6"eturn s			r		/ Wodes ahat sde neo=longr =npthe eecument()#6963					in ( rlem,=& elem.narentNode)) {
				v	// Wandle:)he scsedcwe e aIE&nd tOeratheturn titm s				v	// Wb/dnme )nstread(f eI
						in ( rlem,.d t== fatche02]);{
							seturn reot"Query .ilnd selector.c 
						}
					v	// Wtherwise ,tw )nsjctothe element (irectilyuiteo!he eQuery  objcto
				/	ois aength >=01
					s	ois [] = elem;
					m
					v	ois acntext, =cecument(;				v	ois aolector =="eeector 
	r				eturn fris 
				m
					/ WHANDLE:|$(epr ,u$...)
)			/
else {d ( !montext,)| context .jqery   {{			}return c(pontext, | ceot"Query   .ilnd selector.c ;					/ WHANDLE:|$(epr ,uontext, 				/ W(whih )isjust aequivalnt (ho:|$(ontext,)nilnd epr )			/
else {{			}return cois acnttructir(:iontext,  .ilnd selector.c 
			}

		// WHANDLE:|$(DOMlement )			
else {d ( !oeector sodeType ) {
		/	ois acntext, =cois [] = eeeector 
	r		ois aength >=01
				eturn fris 
				/ WHANDLE:|$(unction()			/ WSoutcut for (ecument()ready			
else {d ( !Query .s unction(f elector ) { {
			return frpeof eeot"Query .ready)!= "sndefined""{

				eot"Query .ready selector ) m
					/ Exescue tmmediately fif)ready&s not rprsente					elector  !Query =;
		}

		/d ( !oeector selector )!= "ndefined") {
		/	ois aolector =="eeector sleector 
	r		ois acntext, =coeector scntext,
			,
		/eturn SQuery .makerray| Eelector  phis i 
		}

/* WGve:oheiinvitfrnction toa eQuery  rototype pir reatr =nptrtcialion 
nvithrototype p=EQuery .in

/* WIniiallnz:ocntsrlu ef erece 
eot"Query  =eQuery  secument())

//ar nearentNsrevi= S/^(?:arentNs|revi(?:Ucial|Al;))/,
	/ Eemthod =guartcied,otorrotduc:og uiqueS=etFahetnierar ng cuom a puiqueS=etF
	guartcied,UiqueS= "
		/oildren
 {rue  
	iontextNs {rue  
	inxt : rue  
	irevi: rue 		}

/Query .eptend 
		ire function( elem  dif  pucial) {
			ar eatcher = m],
				cu = cleme tir ])
				hile ( icu =& ecu sodeType )!= 19&& d(ucial)== "ndefined")| cou sodeType )!= 1 )| c!Query  scu =).s (pucial)  ) {
				f ( !ou sodeType )== 1 ) {
					atched posh( ecu =)
				}			icu = ccu [ir ]
			
	}	eturn Satch rd;	},

	pibling  function( en,elem,) :
		sar ne= [],
	
	vor ( e;in;ine tunextSibling ) {
				f ( nonodeType === 1 && +n)!= 1lem,) :
		sr	rposh( ene 
				

	}

		/eturn re
		}	})

/Query .in.eptend 
		ash function( earget") {
			ar e  
	s	arget"s =eQuery  sarget" phis i 
				enge target"slength;

			eturn cois ailter. unction() { 			ror ( eii 0 ;)n < eng;in++  {
		s		  ( !Query .ontains" sois 
carget"si] ););{
						eturn true;
					
			}

	};);	},

	pylosst  {unction( selector s pontext,) {
			ar ecu 
				 = 0,
		n	l=="ris length  
	s	atcher = m],
				oss  teexd sCntext,test( melector s) {| sypeof eelector s)!= "string" )

				Query  selector s pontext,)| syis acntext,  m
					0
	
	vor ( e;in < e;in++  {
		s	or ( ecu = cois [i];icu =& ecu )!= "cntext,
 cu = ccu narentNode)) {
				v/ IAlway hekipoecument()fragents
		//	f ( !ou sodeType )< 1 && +(oss  					mossindexO(ou  ) -1 ::
				/// Ion't kpss naon-mement  utorizzle.						cu sodeType )== 1 )& 				v	rQuery .ilndpatches elector(:cu 
selector s) ) {

						atched posh( ecu =)
						reak;
					
			}

	};	
		eturn fris losh(tabck eatched pength > 1 )? Query .uiqueS(/atcher =;: [atcher =;;	},

	p* WDetermin:oheiipsitiona(f en element iith in	p* Wth tatched =el of xlements 	rinexO function( elem ) {
				/ WNo{rgument ,heturn tidex ointarentN		/d ( !!lem,) :
		sreturn f eois [] =& (eis [] narentNode)) {?cois ailrs( ;vreviAl;(.length >:-1;
			,				/ Widex ointelector
		/f ( cypeof elem = = nstring" ) {
			return fQuery .snrray| Eeis [] ,eQuery  slem,) :;
		}

		// WLoctoe|he npsitiona(f ehe eefsird =lements		/eturn SQuery .snrray| 				/ WIftit&ecoeve:sog Query  objcto,ehe filst >lement is iued 				lem,.jqery  ?cleme ] = [lem  dhis i 
		}

	pad: {unction( selector  pontext,) {
			eturn fris losh(tabck 
v	rQuery .uiqueS(
				Query .merg( 0ois hget(),eQuery  selector  pontext,) {)			/)			 
		}

	pad:Bck  {unction( selector ) {
			eturn fris lad:(eelector )==null ) 	r		ois areviObjcto:
cyis areviObjctoailter. elector  			 
		}	})

/unction tebling  ecu  dif ) {
		d {
			cu = ccu [tir ])
	} while ( (cu =& ecu sodeType )!= 11{);
		esurn cour
	}	/Query .ach  
		arentN function( elem ) {
			ar earentN  flem.garentNode;
			eturn earent && marent sodeType )!= 11 )? arent &:tull;
		},	farentNs function( elem ) {
			eturn SQuery .ir  elem  d|arentNode",);
		},	farentNsUcial function( elem  di pucial) {
			eturn SQuery .ir  elem  d|arentNode", pucial) 
		},	foxt : unction( elem ) {
			eturn Sebling  elem  d|extSibling ,);
		},	faevi: unction( elem ) {
			eturn Sebling  elem  d|reviouslibling ,);
		},	fextSAl; function( elem ) {
			eturn SQuery .ir  elem  d|extSibling ,);
		},	faeviAl; function( elem ) {
			eturn SQuery .ir  elem  d|reviouslibling ,);
		},	fextSUcial function( elem  di pucial) {
			eturn SQuery .ir  elem  d|extSibling , pucial) 
		},	freviUcial function( elem  di pucial) {
			eturn SQuery .ir  elem  d|aeviouslibling , pucial) 
		},	febling s function( elem ) {
			eturn SQuery .ebling  e !lem.parentNode))| s{}  .ilstChild;,elem,) 
		},	foildren
 {unction( elem ) {
			eturn SQuery .ebling  elem.pilstChild;) 
		},	fontextNs {unction( elem ) {
			eturn SQuery .odeName. elem  d|ifram "  )?				lem,.ontextNocument()| clem,.ontextNWndow.locument m
				Query .merg( 0],
nlem,.oild;Ndes a 
		}	},"unction( eame ,sfn) {
		Query .in[name =]=="unction( eucial,selector ) {
			ar net = "Query .map sois 
cfn pucial) 
			/f ( come.tlice( 0-5);)!= n"Ucial ) {
			rolector =="ucial
		}

		/d ( !oeector =& (epeof eelector )== "string" ) {
				et = "Query .ilter. ielector  pet =;
		}

		/f ( cyis aength >>1 ) {
				/ Tetmve tuplicates 				f ( n!guartcied,UiqueS[name =]= {{			}retu= "Query .uiqueS(/et =;
			}

		/// WRlvryse oder )fr srrentNs*&nd taevi-er ivtive: 				f ( nearentNsrevitest( mame );= {{			}retu= "et .rlvryse( 
				

	}

		/eturn rris losh(tabck eet =;
		}
	})

ar neeothiltS= " /\S+/g);
	

/ Stripg aok Objcto:rtion  iormet scnhed
ar nrtion  Cche,= o{}

/* WCntver atripg -ormet ed brtion  in ok Objcto-ormet ed brn:sogd teoressi coahedEunction toeateIOtion  (brtion  i {
		ar nobjcto= bution  Cche,[brtion  i]= o{}

	Query .ach  brtion  patche(neeothiltS=)|| "],
nanction( e_
nala ) {
			objcto[nala )]= orue;
		};
		esurn robjcto
	}	//
 * UCeateIwacoallack tlit au.ng "hie illoweng  aram eters: *  * 	rtion  :en ertion altlit af eeaces-searamed brtion  ioat soil nchange how * 			oiecoallack tlit abeave s)r a dmresstradiion altrtion  objcto
*  *  Byeefault
dacoallack tlit aoil nato=lie san cvnt (oallack tlit agd tcn be  *  "irsd""{altsiple)times.
*  *  Pssible trtion  : *  * 	rnce:			oil nni.res oiecoallack tlit acn bnly cb filsd brnc ( lie saWDefersd ) *  * 	mtmvry:			oil neep thrck tf ereviousloalue  |and=itl ncll ttcycoallack tad:(d * 					afer.)oe eeit aha secenfilsd beight awaytith the eetes t "mtmvrizd
" * 					alue  |(lie saWDefersd ) *  * 	uiqueS:			oil nni.res acoallack tcn bnly cb fad:(dbrnc ( notuplicates=npthe eeit ) *  * 	eorpOnFlse;:	itererup (oallng"sthetniacoallack teturn s alse;
*  * //Query .Callack s=="unction( ertion  i {
		r/ FCmtver artion  ioom atripg -ormet ed bok Objcto-ormet ed bf (neded 
	/ W(wecoeck ti coahedfilst  		rtion  i=typeof ertion  i== "string" )

		(bution  Cche,[brtion  i]=| coeateIOtion  (brtion  i {)):
		Query .eptend o{},brtion  i 
			ar n/ Wila )o benowbf (eit as iourentNy foirng 	}	oirng ,		// WLst =ilsdoalue !(ilrnon-xilrgetable &eit s)
	vatmvry,		// Wila )o benowbf (eit awa aslready&ilsd 	}	oird[ 			/ Exnd(f ehe eloopthetnioirng 	}	oirng Lngth  
	s* WInex of eourentNy foirng coallack t(modfied ?b iefmve tf (neded )	}	oirng Inex ,		// Wilst >oallack to cflsdo(ued titerealPy cbyfad:ind filseWth )	}	oirng Srar ,		// WActulPxoallack tlit 		/eit a m],
			/ Strck tf eflsdooall urr srepateble &eit s			srck t= !rtion  prnc (& m],
			/ Wilsecoallack s	}	oird=="unction( eata o {
			iatmvry= bution  .atmvry=& dota 
				ilsd b true;
		}	oirng Inex e=filrng Srar {| s0
		}	oirng Srar {=s0
		}	oirng Lngth >=0eit length;
				oirng c true;
		}	or ( e;ieit a& doirng Inex e< oirng Lngth ;doirng Inex ++  {
		s		  ( !eit [doirng Inex e,appely(xota [ 0];,xota [ 1=]= {== "alse;&& cution  .eorpOnFlse;);{
						atmvry= balse;
 / AToerevint()furher doall uu.ng "ad:						reak;
					
			}

	}	oirng c talse;
				  ( !eit   {
		s		  ( !srck t {
		s			  ( !srck length >)>
							olsd !srck llift( ;);
						

				
else {d ( !atmvry=)>
						eit a m],;
				
else {
						ele lisabled ;
			}}
			}

	};,		// WActulPxCallack s=objcto
		ele = n
				/ Tcd =acoallack tr a dolliction
of eoallack s=eo!he elit 		/pad: {unction(  {
		s		  ( !eit =)>
						/ Wilst ,tw )sae:oheiiourentNeength 
					alrserar f=0eit length;
						(unction tadd({rgu u {
					riQuery .ach  brgu 
nanction( e_
nrgu);{
							sar etpe p=EQuery .tpe (nrgu);;
							f ( cypeo=== tAunction("o {
							s	f ( n!ution  .uiqueS=| m!elefhash(nrgu);o {
							s		eit posh( ergu);;
								

							
else {d ( !rgu)& crgulength >& mope )!= 1string" ) {
									/ WInpecit ecursivelly							/pad: ergu);;
							

						
;
						
)({rgument [c 
						/ Iontw )ned,otorad:ioiecoallack s=eo!he 						/ IourentNeoirng cbtche?		s			  ( !oirng c)>
							olsng Lngth >=0eit length;
				v// DWth tatmvry,Cf we 'rejot roirng ch:e 				v// Dw )sorld rcll teight away
					
else {d ( !atmvry=)>
							oirng Srar {=serar ;							oire !atmvry=)
						

				
			}return fris 
				;,		/	/ Tetmve tacoallack trom toe elit 		/pefmve  {unction(  {
		s		  ( !eit =)>
						Query .ach  brguu ntss,"unction( e_
nrgu);{
							ar e nex ;							hile ( ieWidex o=fQuery .snrray| Ergu,!eit ,Widex o;o { -1 : {

				s		eit plpice( 0inex ,c );
				r/	// Wandle:)oirng cidexes.
							f ( coirng c)>
									f ( cidex o<= oirng Lngth o {
							s		oirng Lngth --
									

								f ( cidex o<= oirng Idex o;o
							s		oirng Idex --
									

							

						

					
;
			}}
			}return fris 
				;,		/	/ TCeck tf wa gvelncoallack ts iittoe elit .		/	/ TIfneo=rgument )s igveln,heturn thether dornonteeit aha soallack s=t eched .		/	ash function( efn) {
			}return ffn)?fQuery .snrray| Efn peit =)> -1 :: !!(ieit a& deit length;=;
			}
,		/	/ Tetmve tallsoallack s=rom toe elit 		/pxpty  {unction(  {
		s		eit a m],;
				olsng Lngth >=0,
					eturn fris 
				;,		/	/ THae:oheiieit adononting otcymres		/	isabled {unction(  {
		s		eit a msrck t= atmvry= bndefined"
					eturn fris 
				;,		/	/ TIstit&isabled"?		/	isabled: {unction(  {
		s		eturn f!eit 
				;,		/	/ TLok toeiieit ai tit iourentNmsrcts		/	lok  {unction(  {
		s		srck t= ndefined"
					f ( !matmvry=)>
						ele lisabled ;
			}}
			}	eturn fris 
				;,		/	/ TIstit&lok d"?		/	lok d" {unction(  {
		s		eturn f!srck 
				;,		/	/ TCll ttllsoallack s=ith the egvelncontext,)rd frguu ntss				ilsdWth  function( eontext, xrgu u {
					  ( !eit =& (!s!ilsd b| "erck t {)>
						rgu u=xrgu u| [];
						rgu u=x[eontext, xrgu tlice()?frgu tlice() =
xrgu u,
						  ( coirng c)>
							srck losh( ergu[c 
						
else {
							oire !rgu[c 
						
			}}
			}return fris 
				;,		/	/ TCll ttllsoiecoallack s=ith the egvelncrguu ntss				ilsd {unction(  {
		s		sle lilsdWth  sois 
crgument [c 
					eturn fris 
				;,		/	/ TT benowbf (oiecoallack s=ave talready&ecenfasle(dfaNeenst =rnc 				ilsd" {unction(  {
		s		eturn f!!ilsd 
				

	}
;
		esurn csle 
	


E/Query .eptend 
	
	Defersd  function( efnct) {
			ar ntupls;  t[		s		/ Tation(,rad:ieit tnea,ieit tnea!eit ,Wilal osrcts		/		[ "resolv ",""i nN"
cQuery .Callack s("rnc (atmvry"),|"resolv d" )
					[ "rejcto",""fili"
cQuery .Callack s("rnc (atmvry"),|"rejcto d" )
					[ "ontify" d|aeogress"
cQuery .Callack s("atmvry") ]				,
				ercts= S"ped,ng "
				oromse n={
		s		srctd {unction(  {
		s			esurn cstte 

				;,		/		alway  {unction(  {
		s			defersd .i nN({rgument [c .fili({rgument [c 
						eturn fris 
				m
,		/		h:e  function( e/*EfnD nN
cfnFaal,sfnPeogressc*/) {
	vvvvvar nfn u=xrgument [
						eturn fQuery .Defersd  unction( snewDeferu {
					riQuery .ach  btupls;,"unction( e  toupls);{
							sar efno=fQuery .s unction(f fi.[3i-){ {& efi.[3i-)
				r/	// Wdefersd [ji nN |fiil w (reogressc]fur )iorwar,ng Tation(soo sew Defer				r/	/defersd [joupls01){] unction() { 			r				sar eoturn d e=efno& efiappely(xois 
crgument [c 
									  ( coturn d e& eQuery .s unction(f oturn d .oromse n;o {
							s		oturn d .oromse ()							s			.i nN({ew Defer.resolv  )							s			.fili({ew Defer.rejcto=)							s			.reogress({ew Defer.ontify);;
								
else {
							/		ew Defer[joupls0 0];=+ "Wth ")](phis i== toromse n?{ew Defer.oromse ():
cyis ,ffn)?f[coturn d e]=
xrgument [c 
									

							
 
						}
 
						}fn u=xull;
					}
 .oromse ()
				m
,		/		/ Tet eatoromse nur )his idefersd 		/		/ TIfnobj)s iprovied
,the nreomse napecit s a d:(dbeo!he eobjcto
				reomse  function( eobj) {
		s			esurn cobj)! null ) 1Query .eptend oobj, oromse n;o: oromse 
			}}
			}
,		/	defersd = o{}

/	// AKep tpip;fur )ack -ompiat			oromse .pip;f toromse .h:e 

/	// AAd:ieit -pecifiecEemthod 
riQuery .ach  btupls;,"unction( e  toupls);{
				ar eeit a moupls0 2 )
					stte tripg a moupls0 3=]

			// Toromse [ji nN |fiil w (reogressc]f=0eit lad:				oromse [joupls01){]f=0eit lad:;					/ WHndle:)srcts		/	  ( !srce tripg a {
		s		eit lad:(unction() { 			r		/ Msrcts= S[cotsolv dw (rejcto d ]						ercts= Ssrce tripg 
						/ W[(rejcto_eit a|cotsolv _eit a]lisabled;(reogress_eit leok 			i/} toupls.[3i-^ 1=]0 2 )lisabled toupls.[32=]0 2 )leok =;
			}

		/// Wdefersd [jresolv   (rejcto  (ontify)]		/	defersd [joupls00]=]=="unction(  { 			r	defersd [joupls00]=+ "Wth ")](phis i== tdefersd =? oromse n:sois 
crgument [c 
					eturn fris 
				;;		/	defersd [joupls00]=+ "Wth ")]f=0eit lilsdWth ;		/});
		// WMake he eefaersd =atoromse 			oromse .promse (eefaersd =);
		// WCll tgvelncfnct)f wany
		  ( conct) {
				unctcall( Eefaersd ,eefaersd =);
	}

		// WAl ti nN!
		eturn fefaersd ;	},

	p* WDeaersd =helper		w:e  function( esubor,ngcts=/*E,A...,esubor,ngctsNc*/) {
	vvar e = 0,
		n	resolv Vlue  | Ssice(call( Ergument [c 
				ength >=0resolv Vlue  pength  
			// The scout &of ndompileo d subor,ngctss		n	reaintpg a mength >!= 1 )| c esubor,ngcts=& eQuery .s unction(f subor,ngcts.oromse n;o {? ength >:-0 
			// The smst eruDeaersd .TIfnresolv Vlue  |cnttit af enly ca eng
leuDeaersd ,just aus that .		/	defersd = oreaintpg a = 1 ) esubor,ngcts=:fQuery .Defersd  ,
				// TUpdcts=unction tur )aoh >resolv  nd taeogresscalue  			/updctsunct=="unction( ei pontext,s,ralue  | {
			}return ffnction( ealue ! {
						cntext,.[3i-){=fris 
				m	alue  [3i-){=frgument [pength > 1 )? sice(call( Ergument [c =:fvlue 
				/	  ( !alue  |== torogressVlue  | {
			}r		defersd .ontifyWth  sontext,s,ralue  | 

			r		
else {d ( !m(--reaintpg )| {
			}r		defersd .resolv Wth  sontext,s,ralue  | 

					

				}
				;,					orogressVlue  ,torogressCntext,s,rresolv Cntext,s;
		// Wad:ieit tneasoo sDeaersd =subor,ngctss; teatetnherw hsscotsolv d
		  ( cength >>1 ) {
				orogressVlue  |={ew  rray| Eength;=;
			}orogressCntext,s|={ew  rray| Eength;=;
			}resolv Cntext,s|={ew  rray| Eength;=;
			}or ( e;in < ength ;dn++  {
		s		  ( !resolv Vlue  [3i-){& eQuery .s unction(f otsolv Vlue  [3i-).oromse n;o {
						otsolv Vlue  [3i-).oromse ()							.i nN({updctsunct ei presolv Cntext,s,nresolv Vlue  |)=)							.fili({defersd .rejcto=)							.reogress({updctsunct ei porogressCntext,s,rorogressVlue  | {)
				m
else {
						--reaintpg 
			}}
			}

	};				/ Wi we 'rejot rwaitng on wanyting ,nresolv The smst er
		  ( c!reaintpg a {
				defersd .resolv Wth  sresolv Cntext,s,nresolv Vlue  |);
	}

		/eturn fefaersd .oromse ()
		}	})

//* WTe eefaersd =ued tn wDOM)ready	ar eotadyLit 
	/Query .in.ready&=function( efn) {
		/ AAd:ioiecoallack 
	Query .ready.oromse ().i nN({fn{);
		esurn cris 
	}

/Query .eptend 
		/ TIstoiecDOM)readyoo se aued ? St =eo!hue;frnc (ietncursi.	fisReady:talse;,
	r/ FAscout r.)oothrck thow!atnytitm s)ootwaittur )aefres		/ The sreadyovint()flsds.ISxd #6781		esadyWait: 1,
	r/ FHold (r sreenste)The sreadyovint(
	holdReady:tanction( eholda {
			  ( cholda {
				Query .readyWait++;
	}
else {
				Query .ready srue ));
	}

},

	p* WHndle:)w:e ohe eDOM)is)ready		ready:tanction( ewaitt {
				/ WAbrt ff whe e ade nped,ng cholds)r ae 'rejalready&ready			  ( cwaitt== true;? n--Query .readyWait=:fQuery .isReady) {
			return ;
	}

		// WMake .resnbodyoviste 
crNeenst ,ti coas aIE&et"s aieitte trverzealuslo(tickt =#5443).
		  ( c!ocument.hbodyo {
			return fsetTimeout !Query .ready&);
	}

		// WReember ioat she eDOM)is)ready			Query .isReady) true;
	
		/ TIfnajotrmaleDOM)Readyovint()flsd ,eefcrments mand=iait=f (nedebe  		  ( cwaitt!= true;?& e--Query .readyWait=>0 );{
				eturn ;
	}

		// WI whe e ade nunction  nbund,,)o emescue 		/etadyLit .resolv Wth  socument ,W[(Query  ]=);
		// WTriggr.(ndynbund,sreadyovint(s
/	f ( cQuery .in.triggr.Hndle:ra {
				Query  secument()).triggr.Hndle:r(|"ready"{)
				Query  secument()).off(|"ready"{)
			}		}	})

/**
 * UCean -upEemthodfor (ecmsreadyovint(s
* //unction tdetche  { 		f ( cocument.had:Eint(Lit tnea! {
			ocument.hefmve Eint(Lit tnea(|"DOMCntextNLoaded", ompileo d
nalse;{)
			indow.lefmve Eint(Lit tnea(|"load", ompileo d
nalse;{)
	
}
else {
			ocument.hdetcheEint((|"onreadysrce change", ompileo d{)
			indow.ldetcheEint((|"onload", ompileo da 
		}	}
/**
 * UTe sreadyovint()hndle:rand tellf cean upEemthod
* //unction tompileo d( {
		/ AreadySrcts= = 1sompileo ")s igoo tenugh Qor (us)o cotllsoiececmsreadyoi coldIE		f ( cocument.had:Eint(Lit tnea!| clint(pype === tAload"!| cocument.hefadySrcts= = 1sompileo ") {
			oetche  ;
		Query .ready  
		}	}
/Query .ready.oromse =="unction( erbj) {
		  ( c!readyLit t {
				readyLit t=fQuery .Defersd  ,;
		// WClch )oas scwe e a$ ocument.).ready  as iosle(dfafer.)oe ebrowserovint()hn aslready&ncursrd .		// Dw )rnc (tri(dbeo!us tefadySrcts="itereatiov ")e e ,but "i >oaued tisue s=lie she eone		// Ddiscrverd ?b iCheisS)e e :Ittp://wbugs.jqery com/jtickt /12282#om/ent.:15
/	f ( cocument.hefadySrcts= = 1sompileo ") {
			p* WHndle:)tlwasynchronugslyutoralowe script ihe eoport:unty ftordelay&ready				setTimeout !Query .ready&);

		/ Strcndards-baed tbrowser )suport: DOMCntextNLoaded
		
else {d ( !ocument.had:Eint(Lit tnea! {
			r/ Fse the shndly cvnt (oallack 				dcument.had:Eint(Lit tnea(|"DOMCntextNLoaded", ompileo d
nalse;{)
				r/ FAnalslack to cindow.lonload,ioat soil nalway horks			rindow.lad:Eint(Lit tnea(|"load", ompileo d
nalse;{)
	
}// WI wIE&cvnt (modelis iued 			
else {
				/ Exn.resnoirng cbefres onload,imayb eetesbut "safejalsoQor (ifram s				dcument.hattcheEint((|"onreadysrce change", ompileo d{)
				r/ FAnalslack to cindow.lonload,ioat soil nalway horks			rindow.lattcheEint((|"onload", ompileo da 
	
	}// WI wIE&nd tonttafuram 
	}// WonteinulPy coeck ttttoedbf (oiececument()is)ready				ar ntopc talse;
					ty  
					topc tindow.luram Eement &= null )& documentIlocument Eement 
				;cotch (e)T{

		//f ( tykp>& mo plocScrollo {
					(unction tocScrollCeck ) { 			r		  ( c!Query .isReady) {
								ty  
							r/ Fse the sriptk?b iDiego Pr.ngi							r/ Fttp://wjavascript.nwboxcom/jIECntextNLoaded/							ro plocScroll("left" 
						}
cotch (e)T{							return fsetTimeout !ocScrollCeck , 50c 
						}
					v	// Woetchettllsecmsreadyovint(s
		}r		detche  ;
				v	// Wnd txescue tadynwaitng ounction   			v	/Query .ready  
						

				})( 
				

	}

r
	return cetadyLit .promse (erbj) 
	


E/alrserrndefined")=typeof endefined"
	
	// Eupport: IE<89
/ DItratoon  ovr.(objcto' iite eio daaoperties (befres it iown/alrsi;
or ( eiiineQuery  seuport: ;o {
		reak;
	}
upport.sownLst ==mn == f"0"

/* WNotd {mst-)euport: es tsade nefined")ittoe i srepecitve:omodules.
* Walse;{ucial)he sret as irnd
upport.sinlnedBeok NedesLayoutc talse;
		/ Exescue tASAPti coas aw )ned,otorel obody.style.zoom/Query (unction() { 		/ WMngiied :fvlran,b,c,d
sar ealu difv,obody ponteanedr;
		bodyo eocument.hgetlement sByTagame. e"body") [ 0];
		  ( c!bodyo| m!body.styleo {
			/ WReurn ffr )iram seifocu ioat sdn't kave taobody
		eturn ;
	

	r/ FSturp	rdivo eocument.hreateIlement ( "div)c 
		onteanedro eocument.hreateIlement ( "div)c 
		onteanedr.style.cssTxt, =c"psitiona:absolue ;boder :0;widh":0;height:0;o p:0;left:-9999px"

	bodyappeed,hild;(ponteanedr)).ppeed,hild;(pdiv) 
	
if ( nypeof edivfstyle.zoom == ferrndefined") {
			/ Wupport: IE<8
	/	/ TCeck tf wntive:y cbeok -level&mement  uato=lie sinlned-beok 			/ Tmement  uhetnieettng ch:ei sdisplayto c'inlned'Wnd tgivng 	}	/ The meetyout			oivfstyle.cssTxt, =c"display:inlned;margin:0;boder :0;pad:ng  1px;widh":1px;zoom:1";
			upport.sinlnedBeok NedesLayoutc talu  foivfoffeetWidh"= = 13;
/	  ( !alu! {
			r/ FPecvnt (IE&6cuom a ffcitvg cetyout)fr srsitionad =lements u#11048			r/ FPecvnt (IE&uom asheinkng "hie bodyoi cIE&7(modeu#12869			r/ Fupport: IE<8
	/		body.style.zoom>=01
			;	}

	rbody.efmve hild;(ponteanedr))
	})

////(unction() { 		ar edivo eocument.hreateIlement ( "div)c 
	
	/ Exescue the sret anly cf wnnttalready&xescue ")ittannherwomodule.
if ( upport.detleo Epando ]= null  {
			/ Wupport: IE<89			upport.setleo Epando ]=true;
		}ty  
				etleo foivfret ;
	}
eotch (  ! {
				upport.setleo Epando ]=talse;
			;	}

	r/ FNll )mement  utorvoid teanksoi cIE.	rdivo eull 
	})()

//**
 * UDetermin:sthether da  objctotcn bave tota  * //Query .acceptDta o Sunction( seem ) {
		ar enoDta o SQuery .odDta [ (eem.nodeName.=+" " )toLowerCase() =)
			odeType )= +eem.nodeNype )| m1
	
	/ EDonontrel oata on  aon-mement eDOM)odes aycause oi soil nontrb eceanrd ?(#8335).
	eturn codeType )!= 11{& +ndeType )!= 19&?		/alse;{:				/ WNoes aacceptoata ouness wnherwise neecified ;(rejctoon ton be aontdiion al			!noDta o||enoDta o!= true;?& eeem.petAttribute( "clssuid")=== enoDta 
	


E/alrsrbrce(t S/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
	raltsiDsh;  S/([A-Z])/g

/unction tata Atr( elem  dkey,eata o {
		/ TIfneoting owa aound,titerealPy 
nruy)o cfeche any
	/ Wota orom toe eTML 5Wota -*ottributes		f ( cota o = "ndefined")& elem.nodeType === 1 ) {
				ar enme.==c"dta - + rkeyseplace( rualtsiDsh;, "-$1" )toLowerCase() ;
			ota o flem.petAttribute( name ) 
			/f ( cypeof edta o = "string" ) {
				ty  
					ota o fdta o = "srue;;) 1rue;?
					mdta o = "salse;;) 1alse;{:					mdta o = "sull ;) 1ull ):					m/ Wtly ccmtver atorv1ulber iiftit&does't kchange he setrng 	}				+dta o+"" )== tdta o? +dta o:					mrbrce(test( mata o { 1Query .areseJSON mata o {:					mdta 
				;cotch (  ! {


		/// WMtke .resnweteltthe iata osoQit=fs't kchangedreatr 				Query .ata  elem  dkey,eata o 
			/
else {
				ota o fndefined"
			}	}

	/eturn edta 
	}	// Eoeck stacoace eobjcto)fr sxptyin:ss/unction tisEpty Dta Objcto(prbj) {
		ar enme.
		or ( enme )nsprbj) {
				/ Wi whe nrublicoata onbjcto)s expty ,the nreivti ss nssil nxpty 		/f ( cnme.====c"dta "{& eQuery .s Epty Objcto(prbj[nme. ););{
				onteinu;
			;	}/f ( cnme.=== f"toJSON ) {
			return false;
			;	}

	return true;
	}
/unction titerealPDta  elem  dame ,sdta , pvt=/*EIterealPFse ttly c*/) {
	v  ( c!Query .acceptDta  slem,) :;{
			eturn ;
	

	rar eotu dhis Cche,
			iterealPKe  =eQuery .lpando ,				/ WWebave ttorhndle:eDOM)odes and tJSonbjctosfoif erecty cb ause oIE6-7			/ Won t kGConbjcto)ef erece saaoperty cacrosstoiecDOM-JSobund,ar 		/fsode))=elem.nodeType ,				/ Wtly cDOM)odes aned,ote egloblPFQuery  oace ;tJSonbjctooata ois			/ Wt eched (irectilyueo!he eobjctoosoQGCocn bncurs automaifcluly			cche,= ofsode)) 1Query .cche,= [lem  				/ Wtly cefineng otc ID)fr sJSonbjctosfiftitscoace ealready&xei tsadlowes	}	/ The ccme;)o choutcut fn toa esme.=pah"=n ascDOM)odes=ith tonioahedE	/fd= ofsode)) 1leme titerealPKe   = [lem  titerealPKe   =& eiterealPKe 
	
	/ EAoid tdong otcydmressorksioatnaw )ned,otorw:e ohrypg aok gl oata on  an	p* Wobjctoooat shn anotuta ot sdll	v  ( c(!id{| smoche,[id]=| c(!pvt=& emoche,[id].ata ; {& (ota o = "ndefined")& eypeof enme.====c"tring" ) {
			eturn ;
	

	rf ( (!s") {
			/ Wtly cDOM)odes aned,oa{ew  uiqueS=ID)fr sach emement esinc (t:ei sdta  		/ Tmnds upsittoe egloblPFoahedE	/f ( cisode)) {
				fd= olem  titerealPKe   = tdeleo dIds.pop()|| "Query .guid++;
	}
else {
				fd= ofterealPKe 
			;	}

	rd ( !moche,[bid=]= {{			/ EAoid tlpao.ng "Query  metaata on  plinssJSonbjctosfw:e ohe eobjcto
		/ Wi nserallnz:duu.ng "JSON.tring"ify			cche,[bid=]= ofsode)) 1{}= [{ toJSON:SQuery .odop };
	

	r/ FA  objctotcn bbeyassed to cQuery .ata )nstread(f eadkey/alue !pair;phis iet"s	r/ Fshalowe copi(dbovr.(oteo!he exei tng coahedE	f ( cypeof enme.====c"objcto"{| sypeof enme.====c"unction("o {
			f ( cpvt=;{
				oche,[bid=]= oQuery .eptend ooche,[bid=],name ) 
		}
else {
				oche,[bid=].dta o SQuery .eptend ooche,[bid=].dta , ame ) 
		}

	

	rhis Cche,= ccche,[bid=]
	
	/ EQuery  ata  )ss nssor ")itta searamedonbjcto)snsied`he eobjcto' iiterealPFdta  	/ Wonch )nsprder )torvoid tkeydolliison  nbetwcenfiterealPFdta and tse r-efined"
	/ Wota .	rd ( !mpvt=;{
			d ( !mhis Cche,.ata o {
			ihis Cche,.ata o o{}

	}
				his Cche,= chis Cche,.ata ;
	

	rf ( (dta o!= tndefined") {
			his Cche,[1Query .ccmelase()mame );=]o fdta ;
	

	r/ FCeck tur )aoh >cmtver ed-to-ccmel&nd tonn-cmtver ed(dta oroperty snam s		/ TIfnajdta oroperty swa aeecified E	f ( cypeof enme.====c"tring" ) {
	
	// Wilst >Tuy)o cflndpas-isoroperty sdta  		et = "ris Cche,[1ame =];
		// WTet ailrnoll |ndefined")roperty sdta  		  ( cotu&= null ) {
					/ WTry)o cflndpoiecoamelase(")roperty 			retu= "ris Cche,[1Query .ccmelase()mame );=]
		}

	
else {
			etu= "ris Cche,;	}

	return tet;
	}
/unction titerealPetmve Dta  elem  dame ,spvt=;{
		  ( c!Query .acceptDta  slem,) :;{
			eturn ;
	

	rar ehis Cche,
e  
	sfsode))=elem.nodeType ,				/ WSxd Query .ata )ilrnmressi ormet on 
		cche,= ofsode)) 1Query .cche,= [lem  		/fd= ofsode)) 1leme tQuery .lpando   = [Query .lpando 
	
	/ EI whe e ai aslready&onioahed ntsrynur )his iobjcto,ehe e ai ano
	/ Epurao.e)inponteinung 	}d ( !moche,[bid=]= {{			eturn ;
	

	rf ( (ame );={				his Cche,= cpvt=?ccche,[bid=]= [oche,[bid=].dta 
			/f ( cyis Cche,= {
					/ Wupport: rray )r aeaces searamed btring"snam sfor (eta )key 				f ( n!Query .s rray| Eame );= {{	
			m/ Wruy)oe setrng =n asckeydbefres tcydmanipult on 
		}/f ( cnme.=incyis Cche,= {
					mnme.==c[1ame =];
			}
clse {
						m/ Wlpictpoiecoamelcoas d vryson tbyaeacessouness wsckeydith the eeacessoxei ts					mnme.==cQuery .ccmelase()mame );
				/	  ( !nme.=incyis Cche,= {
					mmnme.==c[1ame =];
			}	
else {
							nme.==come.tlpict( " )
						

				}
	}	
else {
					/ EI w"nam " i asn rray )rf)key ...					/ EW:e oata oisinvitilPy coeateId, via ("key" d|alu")esignaurne,		/		/ Tkey soil ne aontver ed(o cotmelase(.					/ ESinc (t:ee ai ano)wayto ctel n_how_wsckeydia a d:(d,iefmve 					/ Eaoh >plinsskeydgd tcnmelase(rkeysu#12786					/ ETis ioil nnly cpenllnz:ohe erray )rgument )pah".					nme.==come.tontcat !Query .map same ,sQuery .ccmelase(| {)
				

		//f==come.tength;
				hile ( ii--= {
					etleo fris Cche,[1ame i] )]
				

		/// EI whe e ai anotuta oleftsittoe ecche,
ew )wat (hoponteinu 
	}// Wgd tlltthe ioace eobjcto)itsllf gl oaet roye 			vf ( epvt=?c!isEpty Dta Objcto(ris Cche, =:f!Query .s Epty Objcto(ris Cche, = {
			}return 
				

	}

r
	
	/ WSxd Query .ata )ilrnmressi ormet on 
	d ( !mpvt=;{
			etleo foche,[bid=].dta 
			// Ion't kaet roythe nrrent &oace euness wheiinverealPFdta aobjcto
		/ Whad&ecenfhe eonlyueing oleftsittiN		/d ( !!isEpty Dta Objcto(poche,[bid=]= {;{
				eturn ;
	}

r
	
	/ WDet roythe noahedE	f ( cisode)) {
			Query .cean Dta  s mlem,= ,srue ));
	r/ Fse tetleo fhetniepport:d ?ur )lpando s)r a`oahed`&s not ratindow.{pr iisWndow. (#10080)
//* jlift (eqeqeq:talse; /
		
else {d ( !opport.setleo Epando ]| coace e! ccche,.indow.{ {{			/* jlift (eqeqeq:true )/
			etleo foche,[bid=];
	r/ FW:e oal )mee nuails pull 
	
else {
			oche,[bid=]= oull;
		}	}	/Query .aptend 
		oche,:o{},
	r/ FTie illoweng  mement  u(eaces-suffixd,otoraoid tObjctoarototype polliison  )		/ Thero  uiotch ble &excepton  inf youWt exptyotorel olpando  aoperties 	fodDta :{
			"ppell o": rue  
	i"mberdo": rue  
	i/ A...ut "Flsh; nbjctosf(whih )ave ttis iclssuid) *cn *rhndle:elpando s
	i"objcto)": "cluid:D27CDB6E-AE6D-11cf-96B8-444553540000"
},

	phasDta :{unction( elem ) {
			eem,= elem.nodeType =?cQuery .cche, mlem,[Query .lpando ]  = [lem  tQuery .lpando   ;
		eturn f!!eem,=& e!isEpty Dta Objcto(plem,) 
		},	
	ota  function( elem  dame ,sdta = {{			eturn titerealPDta  elem  dame ,sdta ) 
		},	
	rtmve Dta  function( elem  dame = {{			eturn titerealPetmve Dta  elem  dame =;;	},

	p* WFr (iverealPFse oonly.		_ota  function( elem  dame ,sdta = {{			eturn titerealPDta  elem  dame ,sdta ,srue ));
},

	p_rtmve Dta  function( elem  dame = {{			eturn titerealPetmve Dta  elem  dame ,srue ));
},	})

/Query .in.eptend 
		ota  function( ekey,ealue ! {
			ar e  dame ,sdta ,				eem,= eeis [] ,				ttris= elem.)& elem.nttributes ;

		/ SteciflPFlpaetion  nrf).ata )basfclulyeeiwar {Query .access 
	i/ AsoQipileent )he srelevat (beaveir (ourslle: 	
		/ Tet sadlocalue  			d ( !keyd== tndefined") {
			/f ( cyis aength > {
					eta o SQuery .dta  slem,) ;
				vn ( rlem,.odeType === 1 && +!Query ._ata  elem  d"aresedttris"n;o {
						f==cttrislength;
				v/hile ( ii--= {
								/ Wupport: IE<11+							/ WTie ttris=mement  ucn bbeyull )(#14894)							d ( !rtris[3i-){ {{							rnme.==crtris[3i-).nme.
								d ( !ome.tidex Of(|"dta - +)=== e0{ {{							rmnme.==cQuery .ccmelase()mame tlice()5;);
									eta Atr( elem  dame ,sdta [name =]= 
								

						

					

					Query ._ata  elem  d"aresedttris",srue ));
}			}
	}	

			return fdta 
			}				/ WSx  ualtsiple)alue  			d ( !ypeof ekeyd== t"objcto"{ {
			return fyis aach  unction(  { 			r	Query .dta  sois 
ckeyd)
				
);
	}

		/eturn frgument [pength > 1 )?					/ Wux  u nN alue 			ihis aach  unction(  { 			r	Query .dta  sois 
ckey,ealue ! 
				
)::
				/ Tet sa nN alue 			i/ WTry)o cfeche anytiterealPy cssor ")ata )ilst 				eem,=?tata Atr( elem  dkey,eQuery .ata  elem  dkeyn;o {:fndefined"
		},	
	rtmve Dta  function( ekeyn;o{			eturn this aach  unction(  { 			rQuery .remve Dta  eois 
ckeyd)
			})
		}	})

//Query .aptend 
		queue function( elem  dypeo,sdta = {{			ar equeue
			/f ( clem,) :
		srtpe p=E cypeo=| c"fx"{ {+ "queue"
				queue==cQuery ._ata  elem  dypeo= 
	
	}// Wtec:duuptetqueue=byagettng cout)quicky cf wtis iisjust aa ocokrp	r	rf ( (dta o {
		s		  ( !!queue=| "Query .s rray| ata ;{ {{						queue==cQuery ._ata  elem  dypeo,!Query .makerray| ata ;{ ;
			}
clse {
						queuelosh( edta ) 
					}
	}	

		return fqueue=| "[]
		}

	
,	
	oequeue function( elem  dypeo) {
			hpe p=Eypeo=| c"fx";
			ar equeue==cQuery .queue elem  dypeo) 
				ercrtLngth >=0queuelength  
	s	fno=fqueuellift( ; 
	s	hcoks==cQuery ._queueHcoks elem  dypeo) 
				nxt, =cunction(  { 			r	Query .dequeue elem  dypeo) 
				

	
}// WI whie ixequeue=s idequeued,nalway hefmve the nreogresscentenedl		/f ( cfno== t"inaeogress") {
				uno=fqueuellift( ;;				ercrtLngth --
			

		/f ( cfn) {
	
	}// Wcd =acreogresscentenedlotorrocvnt (hie ixequeue=rom tbeng 	}		/ Wgutomaifclulyidequeued			/f ( cypeo=== tAux ) {
					queuelunlift( t"inaeogress") 
				

		/// Eceanruupthe eetstequeue=eorpcunction(
			etleo fhcoks.eorp;				uncall( Elem  daxt, xhcoks=;
		}

		/f ( c!ercrtLngth >& +hcoks=;{
				hcoks.xpty lilsd();
	}

},

	p* Wot riterndd ?ur )rublicocnttumtion  -agenrato:sog queueHcoksiobjcto,eo eoturn soheiiourentNeone		_queueHcoks function( elem  dypeo) {
			ar ekeyd=dypeo)+ "queueHcoks";
		eturn fQuery ._ata  elem  dkeyn;o| "Query ._ata  elem  dkey,{
				xpty  {Query .Callack s("rnc (atmvry")lad:(unction() { 			r	Query ._rtmve Dta  elem  dypeo)+ "queue") 
					Query ._rtmve Dta  elem  dkeyd)
				
)			})
		}	})

/Query .in.eptend 
		queue function( eypeo,sdta = {{			ar eeettdro e2
			/f ( cypeof eope )!= 1string" ) {
				eta o Sope ;		srtpe p=E"fx";
			settdr--
			

		/f ( crgument [pength ><eeettdro {
			return fQuery .queue eeis [] ,eypeo) 
			

		/eturn feta o = "ndefined") 	r		ois {:				his aach  unction(  { 			r	ar equeue==cQuery .queue eois 
capeo,sdta = 
						/ Wni.res achcoks=ur )his iqueue					Query ._queueHcoks eois 
capeo) ;
				vn ( rypeo=== tAux )& +queue00]=!= t"inaeogress") {
				r	Query .dequeue eois 
capeo) ;
				}
	}	
 
		},	foequeue function( eypeo) {
			eturn this aach  unction(  { 			rQuery .dequeue eois 
capeo) ;
		
 
		},	fceanrQueue function( eypeo) {
			eturn this aqueue eopeo=| c"fx","[]) 
		},	f/ Tet eatoromse notsolv dwhetniqueues(f eadcereaneeopeo	f/ Tde nxptyid ?(ixeisoheiiopeo=byeefault
)
	reomse  function( eapeo,sobj) {
		sar ehmp
				cout &= 1,
			defert=fQuery .Defersd  ,,				eem,nt  u eeis 
				 = 0ris length  
	s	resolv T=cunction(  { 			r	d ( !m( --cout &;{ {{						defer.resolv Wth  seem,nt  ,s mlem,nt  u]) ;
				}
	}	

			/f ( cypeof eope )!= 1string" ) {
				obj) Sope ;		srtpe p=Endefined"
			}	}	hpe p=Eypeo=| c"fx";
			hile ( ii--= {
				hmp==cQuery ._ata  elem nt  [3i-),dypeo)+ "queueHcoks") ;
			f ( cymp>& momp.xpty { {{					cout ++;
	}		hmp.xpty lad: eresolv  )
				

	}

r	resolv ();
	}eturn fefaer.promse (erbj) 
		}	})

ar eanu,= e(/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/).source
		ar ecssEpando==c[1"Top" d|Right" d|Bottom" d|Left"=];
	ar e sHiddnge tunction( elem  deu! {
			/ Wi Hiddngemight beiosle(dfrom tQuery #ilter.tunction(;			/ Winooat soas ,element iitl ne aseontdcrgument 
		eem,= ele)| clem,;
		eturn fQuery .css elem  d"display +)=== e"n nN")| c!Query .ontains" slem,.ownraDcument ,Wlem,) 
		}
	
	// EMltsiunction(alEemthodfok gl ond teltralue  |f eadclliction
/* WTe ealue / ucn brtion aly cb fxescue ")iftit'sog unction(
vlranccess==cQuery .nccess==cunction( elem  
cfn pkey,ealue ,kchainbled txpty Gtu draw) {
		ar e = 0,
		nength >=0lem  length  
	sbul t= keyd==oull;
	
	/ WSx  uaanytalue  		f ( cQuery .tpe (nkeyn;o== t"objcto"{ {
			chainbled]=true;
		}or ( eiiinekeyn;o{				Query .nccess elem  
cfn pi pkey[i ,srue  txpty Gtu draw) 
			

		/ Wux  u nN alue 		
else {d ( !alue !!= tndefined") {
			chainbled]=true;
	
		f ( n!Query .s unction(f alue ! { {
			reaw)=true;
		}

		/f ( cbul t {
			r/ FBul tpertaion  nrun agins" (hie ntenretelt
			f ( craw) {
					uncall( Elem s,ealue ! 
					uno=full;
	
		i/ A...exceptwhetnixescueng ounction calue  			/
clse {
					bul t= fn
					uno=function( elem  dkey,ealue ! {
					return fbul call( EQuery  slem,) ,ealue ! 
					}
				

	}

		/f ( cfn) {
			}or ( e;in < ength ;dn++  {
		s		f( elem  [i ,skey,eraw)?ealue !:fvlue call( Elem s[i ,si
cfn elem  [i ,skey! { { 
				

	}

r
			esurn cohainbled]?
		eem,s{:				/ WGt"s	r	bul t?				uncall( Elem so {:				ength >?cfn elem  [0 ,skey! {:txpty Gtu
	


ar eooeck bledype )= (/^(?:oeck box|radio)$/i)

///(unction() { 		/ WMngiied :fvlran,b,c		ar e nputc tocument.hreateIlement ( " nput") 
			divo eocument.hreateIlement ( "div)c 
			fragentso eocument.hreateIDcument Fragents()
	
	/ WSx rp	rdiv.innraTML p=E"  <link/><eble ></eble ><achref='/a'>a</a>< nputctpe ='oeck box'/>"
	
	/ EIEsetrnpstean,ng chiltSeaces hetni.innraTML ps iued 		opport.sean,ng WiltSeaces  foivfilstChild;.odeType === 13
	
	/ EMtke .resnoat shbodyovement  uaent'tWgutomaifclulyins"er ed
	/ EIEsitl nns"er The men ok xpty {eble s		opport.stbodyo e!oivfgetlement sByTagame. e"tbody") length;
	
	/ EMtke .resnoat slinkovement  ugl oserallnz:ducorectilyubyinsnraTML 
	/ ETis irequlsdsratirppeerelement ii cIE		opport.shtmlSerallnz:o e!!oivfgetlement sByTagame. e"link") length;
	
	/ EMtkes .resncloeng otc html5element idoesWot rause oprobem  	r/ FW:ees oue aTML ps iudefined" dhis issil norkss		opport.shtml5Cl nN =
		dcument.hreateIlement ( "nav)c .cloeeode) srue )).oue aTML p!= 1s<:nav></:nav>"
	
	/ ECeck tf wa discrsnrto d oeck boxsitl nesuai tit ioeck ed
	/ Ealue !f eoue )afer.)ppeed,(dbeo!he eDOM)(IE6/7)
	 nput.tpe p=E"oeck box";
	 nput.oeck ed)=true;
		fragents.ppeed,hild;(p nputc 
		opport.sppeed,hick ed)=t nput.oeck ed
	
	/ EMtke .resnoextaena (gd tceck box)eefault
Vlue  isaaoperty ccloeed
	/ Eupport: IE<6-E<11+		div.innraTML p=E"<oextaena>x</eextaena>"
		opport.snoCl nNhick ed)=t!!oivfcloeeode) srue )).etsthild;.efault
Vlue 
	
	/ E#11217 - WebKit&los scoeck tw:e ohe enme.=isfafer.)oe eoeck ed)ttributes		fragents.ppeed,hild;(pdiv) 
		div.innraTML p=E"< nputctpe ='radio'eoeck ed='oeck ed'enme.='t'/>"
	
	/ Eupport: ISafari 5.1,siOS 5.1,sAndrid t4.x,sAndrid t2.3	p* Wold WebKit&does't kcl nN oeck ed)ercts=corectilyui tfragentss		opport.soeck Cl nN = oivfcloeeode) srue )).cloeeode) srue )).etsthild;.oeck ed
	
	/ Eupport: IE<89		/ WtertaidoesWot ral nN vint(s (gd typeof edivfattcheEint(o = "ndefined").
	/ EIE9-10ral nNs vint(s bund,svia attcheEint(,but "oe ysdn't ktriggr.dith t.clik ) 		opport.snoCl nNEint(o true;
		f ( (divfattcheEint(o;{
			eivfattcheEint((|"onclik ",cunction(  { 			ropport.snoCl nNEint(o talse;
			; ;
			oivfcloeeode) srue )).clik ) ;
r
	
	/ Wxescue the sret anly cf wnnttalready&xescue ")ittannherwomodule.
if ( upport.detleo Epando ]= null  {
			/ Wupport: IE<89			upport.setleo Epando ]=true;
		}ty  
				etleo foivfret ;
	}
eotch (  ! {
				upport.setleo Epando ]=talse;
			;	}

})()

//(unction() { 		ar ei
cvint(ame.
			divo eocument.hreateIlement ( "div)c 
	
	/ Eupport: IE<89 (lck tsubmit/change bubbem ,eilsefoxs23+ (lck tfcumsin cvnt )
}or ( eiiine{tsubmit: rue  kchange: rue  kfcumsin:true )} {
			eint(ame.p=E"n("o+si;

		f ( n! upport.[3i-+ "Bubbems")]f=0eint(ame.pineindow.)t {
			r/ FBewde nf eCSPeresription  n(ttp:s://develpert.moztl a.org/en/Scursity/CSP)				oivfstAttribute( nvint(ame.
e"t") ;
			upport.[3i-+ "Bubbems")]f=0eivfattibutes [0eint(ame.p].lpando  == "alse;;
	}

r
			/ FNll )mement  utorvoid teanksoi cIE.	rdivo eull 
	})()

//ar eoormeEem so S/^(?: nput|electo|eextaena)$/i,
	rkeyEint(o t/^key/,
	raose Eint(o t/^(?:aose |poitere|ontext,entu)|clik /,
	rfcumsMorpho t/^(?:fcumsinfcums|fcumsoueblur)$/,
	rypeonam spce(t S/^([^.]*)(?:\.(.+)|)$/

/unction tesurn Tue ) { 		eturn true;
	}
/unction teturn Flse;) { 		eturn talse;;
}
/unction tsafeAitve:lement ( { 		ty  
			eturn fecument.haitve:lement ;
r
eotch ( clrro {
 }	}	//
 * UHelpernunction  nilrnmanagng  mint(s --wnnttpar {o whe nrublicoiterefce(t *  Popesoo sDetc Edwar,s' ad:Eint(slibrarynur )aanyto whe nideas.
* //Query .eint(o t
	
	globlP:o{},
	rad: {unction( elem  dypeos,)hndle:r,sdta ,selectoor) {
		sar ehmp
 mint(s dy,)hndle:ObjIn
				eeciflP
 mint(Hndle:,)hndle:Obj 
	s	hndle:r 
capeo,snam spce(s,eo igype ,				eem,Dta o SQuery ._dta  slem,) ;
			/ Ion't kattche mint(s o seoDta or )hxt,/om/ent.)odes a(ut "alowe plinssnbjctos)
		f ( n!eem,Dta o;{
				eturn ;
	}

		// WCallr doanyasse)ittaneobjcto)f eoustomoata oinslieuto whe nhndle:r
		f ( nhndle:r.hndle:ra;{
				hndle:ObjIno Shndle:r;
	s	hndle:ro Shndle:ObjIn.hndle:r;
	s	electoor) Shndle:ObjIn.electoor;
	}

		// WMtke .resnoat she nhndle:r)hn as uiqueS=ID,=ued to cflnd/efmve tftreatr 			f ( n!hndle:r.guida;{
				hndle:r.guida SQuery .guid++;
	}
	
}// WInctpoiecmement 's vint(ferrnctres ad,saint)hndle:r,sf wtis iisjtedfilst 
		f ( n! mint(s =0lem Dta .eint(s)t {
			rmint(s =0lem Dta .eint(so o{}

	}
			f ( n! mint(Hndle:)=0lem Dta .hndle:)t {
			rmint(Hndle:)=0lem Dta .hndle:o=function( el  {
		s		/ Ioiscar,the eeeontdcvint(ff eadQuery .eint(.triggr.( {ndl		s		/ Ihetnian cvnt as iosle(dfafer.)ayasge)hn aunloadd 		/		eturn trpeof eQuery  == ferrndefined")& (!!e=| "Query .eint(.triggr.d")== fe.tpe ) ?				r	Query .eint(.disptch appely(xmint(Hndle:.lem  drgument [c =:				r	ndefined"
				}
				/ Wcd =lem,)n as roperty so whe nhndle:cfn)torrocvnt (a atmvry=eankdith tIEtonn-ntive:ovint(s
		}mint(Hndle:.lem )=0lem ;
	}
	
}// WHndle:)altsiple)eint(sosearamed bb ca epce(	}	hpe sp=E cypeo u| [")c .mtch ( rnnthiltSn;o| "[[")c]
		}tp=Eypeoslength;
			hile ( it--= {
				hmp==crypeonam spce(.xesc cypeo [t]n;o| "[];		srtpe p=Eo igype p=Eymp[1];		srnam spce(sp=E cymp[2]u| [")c .lpict( ".)c .lrt.  ;
				* WTe es *must*cb facapeo,snokattcheng"snam saces-nly chndle:r 
			f ( c!ypeo) {
					onteinu;
				

		/// EI wcvnt (ohangestit iapeo,sue the sseciflPFlint()hndle:rs=ur )hiekchangedropeo	f		eeciflPo SQuery .eint(.eeciflP[dypeo)]u| [{}

/	/// EI welectoor)efined" ddetermin:sseciflPFlint()apieapeo,soherwise ngvelncopeo	f		tpe p=E celectoor)?sseciflPsetlegmedype p:sseciflPsblndTpeo) {| sypeo

/	/// EUpdcts=seciflPFbaed tn  aewly&reeltthpeo	f		eeciflPo SQuery .eint(.eeciflP[dypeo)]u| [{}

/	/// Ehndle:Obj isaassed to cal )mint()hndle:rs				hndle:Objo SQuery .eptend 
					ypeo:eapeo,					o igype :eo igype ,					ota  fdta ,					hndle:r:)hndle:r,					guid:)hndle:r.guid
					slectoor:celectoor
					ned,sCntext,:celectoor{& eQuery .lpar.mtch .ned,sCntext,test( melectoor) 
					nam saces:snam spce(s.joit(".))				},)hndle:ObjIna 
	
	}// WInctpoiecmint()hndle:raqueue=s we 'rejtedfilst 
			f ( n! hndle:rs==0eint(s[dypeo)];{ {{					hndle:rs==0eint(s[dypeo)]  m],;
				hndle:rssetlegmedCout &= 0
						/ Wtly cue tad:Eint(Lit tnea/attcheEint(oi whe nseciflPFlint(s)hndle:raoturn soalse;
		r	d ( !mseciflPssx rpb| "eeciflPssx rpcall( Elem  ddta , ame spce(s,emint(Hndle:)) == "alse;! {
					r/ FBlndpoiecgloblPFmint()hndle:raeo!he exement 					rn ( rlem,.ad:Eint(Lit tnea! {
			r			eem,lad:Eint(Lit tnea(|apeo,smint(Hndle:,)alse;{)
				r		
else {d ( !lem.nttrcheEint(o;{
			r			eem,lattcheEint((|"on"o+sapeo,smint(Hndle:c 
						
			}}
			}

		//f ( teeciflPsad:i;{
			r	eeciflPsad:call( Elem  dhndle:Objo ;
				vn ( r!hndle:Obj.hndle:r.guida;{
			r		hndle:Obj.hndle:r.guida=)hndle:r.guid;			}}
			}

		/// Wcd =eo!he exement 's)hndle:raeit ,Wetlegmedsui tfron 
			f ( nelectoor) {
		s		hndle:rsslpice( 0hndle:rssetlegmedCout ++, 0 dhndle:Objo ;
		/
clse {
					hndle:rssosh( ehndle:Objo ;
		/

		/// WKep thrck to wwhih )lint(s)hne:ovinr&ecenfued ,?ur )lint(ffptimizt on 
		}Query .eint(.globlP[dypeo)]  mrue;
		}

		// FNll ify)lem )torrocvnt (atmvry=eanksii cIE			eem,= eull;
		}

	p* WDetchettn cvnt ao eeetto wlint(s)uom a nexement 		efmve  {unction( elem  dypeos,)hndle:r,selectoor
saippedTpeos) {
		sar ej,)hndle:Obj ehmp
				o igCout  dy,)mint(s 				eeciflP
 hndle:r 
capeo,		srnam spce(s,eo igype ,				eem,Dta o SQuery .hasDta  clem,) :& eQuery ._dta  slem,) ;
			f ( n!eem,Dta o| c! mint(s =0lem Dta .eint(s)t {
			return ;
	}

		// WOnc (fr sach eapeo.nam spce(tneeopeos; tpeo)ma cb fomit ed
		hpe sp=E cypeo u| [")c .mtch ( rnnthiltSn;o| "[[")c]
		}tp=Eypeoslength;
			hile ( it--= {
				hmp==crypeonam spce(.xesc cypeo [t]n;o| "[];		srtpe p=Eo igype p=Eymp[1];		srnam spce(sp=E cymp[2]u| [")c .lpict( ".)c .lrt.  ;
				* WUnblndpalPFlint(s)(o this  ame spce(,sf wprovied
)=ur )hiekxement 				f ( c!ypeo) {
					or ( eypeo)in cvnt  | {
			}r	Query .eint(.efmve  elem  dypeo)+ ypeo [ t-),dhndle:r,selectoor
srue ));
}			}
	}		onteinu;
				

		//eeciflPo SQuery .eint(.eeciflP[dypeo)]u| [{}

f		tpe p=E celectoor)?sseciflPsetlegmedype p:sseciflPsblndTpeo) {| sypeo

			hndle:rs==0eint(s[dypeo)] | "[];		srtmp==cymp[2]u& +new RegExp( "(^|\\.)"o+snam spce(s.joit("\\.(?:.*\\.|)" {+ "(\\.|$)"a 
	
	}// Wetmve  mtch ng  mint(s				o igCout o SQa=)hndle:rstength;
				hile ( ij--= {
					hndle:Objo Shndle:rs[SQa];
				vn ( r(saippedTpeos)| "o igype p== Shndle:Obj.o igype p :& 			}r	 n!hndle:r)| "hndle:r.guida== Shndle:Obj.guida;{& 			}r	 n!tmp=| symptest( mhndle:Obj.nam spce(t)a;{& 			}r	 n!electoor)| "electoor) = Shndle:Obj.electoor)| "electoor) = S"** )& +hndle:Obj.electoor))a;{
			r		hndle:rsslpice( 0j e1{)
				r		f ( nhndle:Obj.electoor))a
			r			hndle:rssetlegmedCout --
						}
	}		/f ( teeciflPsefmve t)a
			r			eeciflPsefmve call( Elem  dhndle:Objo ;
					
			}}
			}

		/// Wetmve  genraicFmint()hndle:ras we hefmve d soemthng otc tonnmresshndle:rs=xei t		/// W(void saaoextNflPofr sadle:s ireursion taurng =efmvelPoo wseciflPFlint()hndle:rs)				f ( co igCout o& +!hndle:rstength;o {
		s		  ( !!eeciflPsteardownb| "eeciflPsteardowncall( Elem  dame spce(s,emem Dta .hndle:o) == "alse;! {
					rQuery .remve Eint((|lem  dypeo,!mem Dta .hndle:o);
}			}
					otleo feint(s[dypeo)]
				

	}

		// Wetmve  he exeando  iftit'soonnlongr.dued 			f ( cQuery .s Epty Objcto(pcvnt  | { {
				etleo feem Dta .hndle:
	
	}// Wrtmve Dta jalsoQoeck stfr sxptyin:ssdgd tceanrs he exeando  iftxpty 		/i/ AsoQse oi snstread(f eetleo 
		}Query ._rtmve Dta  elem  d"cvnt  "{)
			}		}

	ptriggr. {unction( elint(,bdta , lem  dnly Hndle:rs= {
		sar ehndle:,)ntepeo,!urs,				bubbemype , eeciflP
 hmp
 i,
		}mint(Pah >=0 mlem,=| cocument. )
				tpe p=EhasOwncall( Elint(,b"tpe "{ {?clint(pype =:Elint(,		srnam spce(sp=EhasOwncall( Elint(,b"nam spce("{ {?clint(pnam spce(.lpict( .))=:E[];
			urs =cymp= elem.)=mlem,=| cocument.
			// Ion't kaopcvnt  |o thxt, gd tcm/ent.)odes 
	rn ( rlem,.odeType === 13)| clem,.odeType === 18t {
			return ;
	}

		// Wfcums/blurnmrephs o sfcumsin/out;Wni.res e 'rejot roirng che meright now
	rn ( rrfcumsMorphtest( mypeo)+ Query .eint(.triggr.d"))t {
			return ;
	}

		/f ( cypeotidex Of( .))=> e0{ {{				/ FNam spce(dktriggr.;coeateI aWrtgxea o smtch Flint()ypeo)in hndle:()				nam spce(sp=Eypeotlpict( .))

f		tpe p=Enam spce(s.lift( ;;				nam spce(s.lrt.  ;
		

	}ntepeop=Eypeotidex Of( :))=<e0{& +"on"o+sapeo;
		// WCll r doanyasse)itta Query .Eint(oobjcto,eObjcto,eo eust aanFlint()ypeo)etrng 	}	eint(o teint( tQuery .lpando   =?
		}mint(=:				new Query .Eint((|apeo,srpeof eeint(o = ""objcto"{& elint(o;;
		// WTriggr.(bitmask: &e1{ilrnotive:ohndle:rs; &e2{ilrnQuery  (alway hrue )	}	eint(.s Triggr.(=dnly Hndle:rs=?e2{:13;
/	lint(pnam spce(p=Enam spce(s.joit(".));
/	lint(pnam spce(_rto teint(pnam spce(p?				new RegExp( "(^|\\.)"o+snam spce(s.joit("\\.(?:.*\\.|)" {+ "(\\.|$)"a =:				nll;
	
		/ WCean uupthe ecvnt as coas ait=fstbeng Wrtued 			eint(.efsultp=Endefined"
			f ( n!eint(.targl o {
			rmint(.targl o=0lem ;
	}
	
}// WCl nN anytitcm/ng Wdta and troceed,the ecvnt ,coeateng "hie hndle:ranrgaeit 
		ota o fdta o =yull )?				[0eint(  = 
		}Query .makerray| bdta , [0eint(  =;;
		// WAlowe seciflPFlint(s)tordraw)outsied`he elned 
	reeciflPo SQuery .eint(.eeciflP[dypeo)]u| [{}

f	f ( n!nly Hndle:rs=& eeeciflPstriggr.(& eeeciflPstriggr.appely(xmem  ddta o) == "alse;! {
				eturn ;
	}

		// WDetermin:0eint( ropeagtoon  pah"=ittadvane(,spernW3C)eint(soseci (#9951)
	r/ FBubbemuupthosocument ,Wt:e oh cindow.; wtch FilrnacgloblPFownraDcument fvlra(#9724)
f	f ( n!nly Hndle:rs=& e!eeciflPsnoBubbemu& +!Query .isWndow. slem,) :;{
					bubbemype o SseciflPsetlegmedype p| sypeo

			  ( c!rfcumsMorphtest( mbubbemype o+eypeo) { {
					ors =cors.rrent ode)
				

	}}or ( e;iors;iors =cors.rrent ode){ {
					mint(Pah sosh( eors );
}			ymp= eors;			}

		/// Wtly cad:iindow.{s we hgotthosocument  (e.g.,wnnttplinssnbj or)efeched (DOM)				f ( cymp= = "(lem,.ownraDcument =| cocument.){ {
					mint(Pah sosh( eymptefault
View | symptrrent Wndow. | sindow.{ 
				

	}

		// Wilseshndle:rs=n toa eeint( rah 
		 = 00
			hile ( i(ors =cmint(Pah [i++] :& e!eint(.s Popeagtoon Stopped( :;{
					lint(pype ==mn  1 )?					bubbemype o:				rseciflPsblndTpeo)| sypeo

/	/// EQuery  hndle:r
			hndle:o=f(eQuery ._dta  surs,d"cvnt  "{)u| [{}) [ lint(pype =]:& eQuery ._dta  surs,d"hndle:") ;
			f ( chndle:o) 
					hndle:appely(xurs,ddta ) 
				

		/// WNtive:ohndle:r
			hndle:o=fntepeop& eurs[fntepeop];
			f ( chndle:o& +hndle:appely:& eQuery .acceptDta  sors ){ {
					mint(.efsultp=Ehndle:appely(xurs,ddta ) 
				rn ( rlint(.efsultp== "alse;! {
					rlint(.rocvnt Dfault
();
}			}
	}	

	}

r	lint(pype ==mapeo;
		// WIfneobodyorocvnt d,ote eefault
uatoon ,kaopit now
	rn ( r!nly Hndle:rs=& e!eint(.s Dfault
Pocvnt d,( :;{
					  ( c(!seciflPs_efault
u| "eeciflPs_efault
appely(xmint(Pah soop() ddta o) == "alse;;{& 			}rQuery .acceptDta  slem,) :;{
				}r/ WCll oa{etive:oDOM)emthodfn toa etargl oith the eeme.pnme.pnme.pastoa eeint(.			}r/ WCl't kue tani.i unction(f)coeck te es b ause oIE6/7nuailsnoat shst(.			}r/ Won't kaopefault
uatoon s=n tindow.,ioat 'scwe e agloblPFvlrible scb f(#6170)				rn ( rntepeop& eeem  type =]:& e!Query .isWndow. slem,) :;{
					}r/ Won't kre-triggr.(ndrntFOOeeint( hetniweiosletit iFOOf)cemthod
	}			ymp= eeem  tntepeop];

	}		/f ( tymp=;{
			r			eem, tntepeop]= eull;
		}			}
					r/ WPecvnt (re-triggr.ng cofthe eeme.pcvnt ,csinc (w ealready&bubbemd)tlwabve 						Query .eint(.triggr.d") Sope ;		sr		ty  
							eem  type =]  
						
eotch ( cl=;{
			r			/ EIE<9 des (onWfcums/blurntorhiddngelement i(#1486,#12518)			r			/ Enly coceroducibemun tindXPEIE8{etive:,wnnttIE9ii cIE8(mode						}
	}		/Query .eint(.triggr.d") Sndefined"
	
	}		/f ( tymp=;{
			r			eem, tntepeop]= eymp;
					
			}}
			}

		

		/eturn flint(.efsult
		}

	pdisptch  {unction( elint(:;{
				/ WMtke atirieble  Query .Eint(orom toe entive:ovint(aobjcto
		eint(o tQuery .eint(.fix(elint(o;;
		/ar ei
cotu dhndle:Obj emtch d ,?j 
	s	hndle:rQueue==c[ ,				trgsp=Elice(call( Ergument [c  
	s	hndle:r o=f(eQuery ._dta  sois 
c"cvnt  "{)u| [{}) [ lint(pype =]:| "[] 				eeciflPo SQuery .eint(.eeciflP[dlint(pype =]:| "{

	
}// Wse the sfix-d")Query .Eint(oraherwooatnahe s(read-nly )entive:ovint(
		trgs00]==cmint(;
/	lint(petlegmedyargl o=0ois ;
		// WCll the nreeDisptch chcok=ur )hiekaipped|apeo,sad tlltttlwbail{s wdeslse 			f ( ceeciflPsreeDisptch c& eeeciflPsreeDisptch call( Eois 
clint(:;{== "alse;! {
				eturn ;
	}

		// WDetermin:0hndle:rs			hndle:rQueue==cQuery .eint(.hndle:rstall( Eois 
clint(
 hndle:r =;;
		// WRunWetlegmedsuilst ;"oe ysma cwat (hopeorpcropeagtoon  beneah"=us
		 = 00
			hile ( i(mtch d o Shndle:rQueue[dn++ ] :& e!eint(.s Popeagtoon Stopped( :;{
			rlint(.ourentNyargl o=0mtch d .lem ;

		}Q= 00
				hile ( i(hndle:Objo Smtch d .hndle:rs[SQ++ ] :& e!eint(.s ImmedimedPopeagtoon Stopped( :;{
					// WTriggr.edcvint(fmust eiherwo1))hne:ono ame spce(,sor				// W2))hne:onme spce((s)ca eubeettor equal=eo!heo.e)inphie boutdcvint(f(aoh >cn bave tno ame spce().				rn ( r!lint(pnam spce(_rto| clint(pnam spce(_rttest( mhndle:Obj.nam spce(t)a;{
					}reint(.hndle:Objo Shndle:Obj;				}reint(.ota o fhndle:Obj.dta 
			/			etu= " i(Query .eint(.eeciflP[dhndle:Obj.o igype p]:| "{
).hndle:o| "hndle:Obj.hndle:r )			r				appely(xmtch d .lem  drgus{)
				r		f ( netu=!= tndefined") {
				r		f ( n(mint(.efsultp=Eetu) == "alse;! {
					r	rlint(.rocvnt Dfault
();
}			r	rlint(.eorpPopeagtoon ();
}			r	

					

				
			}

		

		// WCll the nrostDisptch chcok=ur )hiekaipped|apeo			f ( ceeciflPsrostDisptch c {
				ueciflPsrostDisptch call( Eois 
clint(:;;
	}

		/eturn flint(.efsult
		}

	phndle:rs {unction( elint(,bhndle:r =;{{			ar eeel dhndle:Obj emtch ds
 i,
		}hndle:rQueue==c[ ,				etlegmedCout &= hndle:rssetlegmedCout 
				crs =cmint(.targl ;
		// Wiltdcetlegmed0hndle:rs			/ FBlck -hoe:oSVG <se >snstranc (tres a(#13180)
/// WAoid tonn-left-clik &bubbeng cinpilsefoxs(#3861)
f	f ( netlegmedCout && eurs.odeType =& (!!eint(.buttono| clint(pope )!= 1sclik ")a;{
					/* jlift (eqeqeq:talse; /
		}}or ( e;iorse! cois ;iors =cors.rrent ode){| syis   {
		s		/* jlift (eqeqeq:true )/
				}r/ Won't koeck taon-mement  a(#13208)			r	/ Won't kropcess=clik  (onWdisabemd)mement  a(#6911, #8165,E#11382,E#11764)				rn ( rurs.odeType === 1 && +(ors.disabemd)!= true;?| clint(pope )!= 1sclik ")a;{
						mtch ds  m],;
				}or ( eii 00
in < etlegmedCout ;dn++  {
		s				hndle:Objo Shndle:rs[Sip];

	}		/r/ Won't koonflik oith tObjctoarototype paoperties ((#13203)			r			eel  Shndle:Obj.electoor)+" " ;

	}		/rn ( rmtch ds[eeelp]= = tndefined") {
				r			mtch ds[eeelp]= mhndle:Obj.ned,sCntext, ?				r			/Query (eeel dyis   tidex  sors ){> e0{:				r			/Query .flnd(eeel dyis  pull , [0ors ]) length;
	}			r	

					rn ( rmtch ds[eeelp]= {
				r			mtch dssosh( ehndle:Objo ;
		/	r	

					

				rn ( rmtch dstength;o {
		s			}hndle:rQueuesosh( {)meme:xurs,dhndle:rs {mtch ds } ;
					
			}}
			}

		

		// Wcd =ee sreaintng c(irectily-boutd)0hndle:rs			f ( netlegmedCout &<)hndle:rstength;a;{
				hndle:rQueuesosh( {)meme:xyis  phndle:rs {hndle:rsslice( 0etlegmedCout &) 
);
	}

		/eturn fhndle:rQueue
		}

	pfix {unction( elint(:;{
		rn ( rlint( tQuery .lpando   = {
			return fmint(;
/	

		// WCeateI aWirieble  cop so whe nvint(aobjctootc tonrmllnz:osoem aoperties 	f/ar ei
caope, cop 
				tpe p=Elint(pope 
				o iginalEint(o teint( 
	s	fixHcoko=0ois .fixHcoks[dypeo)]
	
	rn ( r!fixHcoko {
				his .fixHcoks[dypeo)]o=fuixHcoko=			}}raose Eint(test( mypeo) {?chis .aose Hcoksi:				rrkeyEint(test( mypeo) {?chis .keyHcoksi:				r{}

	}
			cop s=fuixHcokarotps{?chis .rotpstontcat !uixHcokarotps{)=:Ehis .rotps
	
	reint(o tnew Query .Eint((|o iginalEint(o ;
			f =coop length;
			hile ( ii--= {
				rotp =coop [Sip];
r	rlint([caope)]o=fo iginalEint([caope)];
/	

		// Wupport: IE<89			/ Wilxetargl oroperty s(#1925)
		f ( n!eint(.targl o {
			rmint(.targl o=0o iginalEint(.srclement =| cocument.
	/	

		// Wupport: IChroem 23+,ISafari?		// Wyargl oshouldnontrb eathxt, odes=(#504,E#13143)		rn ( rlint(.targl .odeType === 13) {
			rmint(.targl o=0lint(.targl .rrent ode)
			

		// Wupport: IE<89			/ Wilrnmrse /key!cvnt  , metaKey==alse; iftit'sondefined")(#3368,E#11328)	}	eint(.metaKey =t!!eint(.metaKey;
		/eturn fuixHcokailter.t?fuixHcokailter. elint(,bo iginalEint(o =:Elint(
		}

	p* WInclues asoem eint( ropesFshard bb cKeyEint(otc tMose Eint(
	reops {"altKey bubbem ucn celble  ctrPKe  ourentNyargl omint(Phas ametaKey reeatrdyargl oshiftKey targl otimeStamp view whih "tlpict( " )

	pfixHcoks f{},
	rkeyHcoks:{
			reops {"chr echr Cdes=key!keyCdes"tlpict( " )

s	fiter. {unction( elint(,bo iginala;{
					/ Wcd =whih )or (key!cvnt  
		rn ( rlint(.whih )= null ) {
		r	rlint(.whih )=bo iginal.chr Cdes=!=yull )?bo iginal.chr Cdes=:bo iginal.keyCdes
				

		//eturn fmint(;
/	

	}

	paose Hcoks:{
			reops {"buttonobuttons=clint(X=clint(Yorom lement =offeetX=offeetYyasgeXyasgeY scresnX scresnY=eolement "tlpict( " )

s	fiter. {unction( elint(,bo iginala;{
		f/ar ebody
clint(Doc,kaoc
					buttono=bo iginal.button
					rom lement ==bo iginal.rom lement 

/	/// ECllcult eyasgeX/Y iftmissng otc tclint(X/Y availble 
		rn ( rlint(.asgeXy= null )& +o iginal.clint(X=! null ) {
		r	rlint(Doco=0lint(.targl .ownraDcument =| cocument.;
				doco=0lint(Dcu.ocument.lement ;
r			bodyo elint(Dcu.body;

	}		lint(.asgeXy=+o iginal.clint(X=+( neoco& (ocu.scrollLeft=| cbodyo& (body.scrollLeft=| c0{ {-( neoco& (ocu.clint(Left=| cbodyo& (body.clint(Left=| c0o ;
		/	lint(.asgeYy=+o iginal.clint(Y=+( neoco& (ocu.scrollTpe)=| cbodyo& (body.scrollTpe)=| c0{ {-( neoco& (ocu.clint(Tpe)=| cbodyo& (body.clint(Tpe)=| c0) 
				

		/// Wcd =reeatrdyargl ,sf wnecessar 		/	f ( n!eint(.reeatrdyargl o& (rom lement = {
					mint(.efeatrdyargl o=(rom lement === 1mint(.targl o?bo iginal.eolement =:brom lement 

			

		/// Wcd =whih )or (clik :1 &== 1left; 2&== 1midle:
13)== 1right		/// WNote:obutton&s not ronrmllnz:d,AsoQdn't kse oi 		/	f ( n!eint(.whih )& (button&!= tndefined") {
				rlint(.whih )=b((button&&e1{?e1{:b((button&&e2{?e3{:b((button&&e4=?e2{:10! { { 
				

		//eturn fmint(;
/	

	}

	pueciflP:{
			load:{{				/ FPecvnt (triggr.d")imsge.loadwlint(s)uom abubbeng ch cindow..load				noBubbem:true 
/	


s	fcums:{{				/ Filsesntive:ovint(af wpossnle  soQblur/fcumseeequece as ioorecti				hriggr. {unction(  {
		s		  ( !yis  == feafeAitve:lement ( {& mois .fcumse {
		s			ty  
							ois .fcums();
}			r	eturn false;
						
eotch ( cl=;{
			r			/ Eupport: IE<89			r			/ EI we herrr (onWfcumsntorhiddngelement i(#1486, #12518),			r			/ Elltt.triggr.( {run hie hndle:rs
					
			}}
			}
,				etlegmedype :e"fcumsin"
/	


s	blur:{{				hriggr. {unction(  {
		s		  ( !yis  == feafeAitve:lement ( {& mois .blurn {
		s			tis .blur();
}			return false;
					
			}
,				etlegmedype :e"fcumsout"
/	


s	clik :1{				/ Fir (ceck box,uilsesntive:ovint(asoQoeck ed)ercts=itl ne aright		//hriggr. {unction(  {
		s		  ( !Query .oddeame. eois 
c" nput") {& mois .tpe === 1"oeck box"{& mois .clik & {
		s			tis .clik ) ;
r			return false;
					
			}
,					/ Fir (cross-browsr doonsit tncy,Qdn't kilsesntive:o.clik ) (onWlinks
			_efault
 {unction( elint(:;{
		r		eturn fQuery .oddeame. emint(.targl 
c"a"{ 
				

	}
,				befresunload:1{				rostDisptch  {unction( elint(:;{
						/ Eupport: Iilsefoxs20+					/ Eilsefoxsdoes't kaler Ti whe neturn Vlue  fieldns not reet.				rn ( rmint(.efsultp!= tndefined")& elint(.o iginalEint(o =
					rlint(.o iginalEint(.eturn Vlue  =rmint(.efsult;
}			}
	}	

	}

r}

	puimult e function( eapeo,slem  dlint(,bbubbem  {
			/ WPiggybck totta dn'r )lint(fhopeimult ewa diffeentNeone.			/ Witke o iginalEint(otorvoid tdn'r ' nssopPopeagtoon ,but "i whe 			/ Weimult ed eint( rolint(s)efault
utetniweidothe eeme.pn toa edn'r .	f/ar ee==cQuery .eptend 				new Query .Eint((),
		}mint(,
		}
					ypeo:eapeo,					isSimult ed: rue  
	i		o iginalEint( f{}
	}	

	})

f	f ( nbubbem  {
			/Query .eint(.triggr. rm pull , lem,) ;
	/
clse {
				Query .eint(.disptch aall( Elem  d ) 
		}

	rn ( rm.s Dfault
Pocvnt d,( :;{
			rlint(.rocvnt Dfault
();
}	;	}

}

/Query .remve Eint(  eocument.hremve Eint(Lit tnea!?	pfnction( elem  dypeo,shndle:o) 
			n ( rlem,.remve Eint(Lit tnea!;{
			rlem,.remve Eint(Lit tnea(dypeo,shndle:,)alse;{)
	}	;	}
i:		fnction( elem  dypeo,shndle:o) 
			ar enme.p=E"n("o+sapeo;
		/n ( rlem,.efecheEint(:;{
					/ E#8545,E#7054, rolint(ng catmvry=eanksior (customolint(s)i cIE6-8				/ EefecheEint(:ned,d")roperty sogelement ,bb cnme.po wheatdlint(,btoaaoperty cexao.e)i(otorGC		/	f ( nrpeof eeem, tame =]=== ferrndefined") {
				rlem, tame =]==eull;
		}	

		//lem,.efecheEint( same ,shndle:o);
}	}		}
	
Query .Eint(o=function( esrc, rotps{)={
// WAlowe nstrantitoon  ith ot "oe  'new'(keywor E	f ( c!(tis iistranc f eQuery .Eint( :;{
			eturn tnew Query .Eint((|src, rotps{);
r
	
	/ Wxint(aobjcto
	f ( cerco& (erc.ypeo) {
			tis .o iginalEint(o terc;			tis .tpe p=Eerc.ypeo;
		// WEint(s)bubbeng cupthe eocument  ma cave tecenfmar ed)tsorocvnt d,		// Wb ca hndle:raeow:radownboa etre:
1sefecto)hiekcorectifvlue c			tis .s Dfault
Pocvnt d,p=Eerc.dfault
Pocvnt d,p||				rerc.dfault
Pocvnt d,p== tndefined")& 					/ Eupport: IIE < 9,sAndrid t< 4.0				rerc.eturn Vlue  == "alse;!?		//eturn Tue i:				eturn Flse;;	
	/ Wxint(aapeo		
clse {
			tis .tpe p=Eerc;
r
	
	/ WPu olpalikiilyuprovied
paoperties (oneo!he exint(aobjcto
	f ( crotps{)={
/	Query .eptend eois 
crotps{);
r
	
	/ WCeateI aWtimestamp iftitcm/ng Wxint(adoes't kave tone		tis .timeStamp =cerco& (erc.yimeStamp | "Query .now()
	
	/ WMar )tlwasuilxd,		eis [tQuery .lpando   = mrue;
	}
	
/ EQuery .Eint(ofstbaed tn  DOM3WEint(s)asoseciiied Wb che eECMAScript Langusge)Blndng 	/ Ehttp://www.w3.org/TR/2003/WD-DOM-Lxinl-3-Eint(s-20030331/ecma-script-blndng shtml
Query .Eint(arototype p t
		s Dfault
Pocvnt d,:teturn Flse;,		s Popeagtoon Stopped:teturn Flse;,		s ImmedimedPopeagtoon Stopped:teturn Flse;,	
	recvnt Dfault
 {unction(  {
		sar ee==ctis .o iginalEint(;
		/tis .s Dfault
Pocvnt d,p=Eeturn Tue 

f	f ( n!;! {
				eturn ;
	}

		// WIf recvnt Dfault
=xei t 
crun itpn toa eo iginalaeint(
	rn ( rm.recvnt Dfault
=;{
			rl.rocvnt Dfault
();

		/ Eupport: IIE
		/ EOherwise nsetwhe neturn Vlue  roperty so whe no iginalaeint( o sflse;
		
clse {
				e.eturn Vlue  =ralse;;
	}

r
,		ssopPopeagtoon  {unction(  {
		sar ee==ctis .o iginalEint(;
		/tis .s Popeagtoon Stoppedp=Eeturn Tue 

f	f ( n!;! {
				eturn ;
	}

/// EI wesopPopeagtoon =xei t 
crun itpn toa eo iginalaeint(
	rn ( rm.esopPopeagtoon =;{
			rl.eorpPopeagtoon ();
}	

		// Wupport: IE<
		/ Wux )hiekcn celBubbemuroperty so whe no iginalaeint( o srue 
/	(cal celBubbemu mrue;
		
,		ssopImmedimedPopeagtoon  {unction(  {
		sar ee==ctis .o iginalEint(;
		/tis .s ImmedimedPopeagtoon Stoppedp=Eeturn Tue 


	rn ( rm)& el.ssopImmedimedPopeagtoon =;{
			rl.eorpImmedimedPopeagtoon ();
}	

		/tis .eorpPopeagtoon ();
}}	}
	
/ ECeateI aose nt dr/eane:ovint(s usng oaose ve r/outotc tvint(-yimeQoeck s/Query .ech  {	paose nt dr: "aose ve r",	paose eane:: "aose vut",	ppoiterent dr: "poitereve r",	ppoitereeane:: "poiterevut"
},cunction( no ig,uilx=;{
		Query .eint(.eeciflP[do ig  = m
			etlegmedype :eilx

s	blndTpeo:eilx


		hndle: {unction( elint(:;{
		r	ar eoe(,
		}	targl o=0ois ,		r		etlt ed =rmint(.efeatrdyargl ,		r		hndle:Objo Smint(.hndle:Obj;					/ Fir (aose t dr/eane:ocll the nhndle:ras wetlt ed fstoutsied`he etargl .				/ FNB: No reeatrdyargl oi whe naose 1left/ t drd,ote ebrowsr dindow.		/	f ( n!etlt ed | "(etlt ed != trargl o& (!Query .ontains" stargl 
cetlt ed )){ {
					mint(.tpe p=Ehadle:Obj.o igype ;		r		etup=Ehadle:Obj.hndle:r.ppely(xois 
crgument [c ;					mint(.tpe p=Eilx
				

	}	eturn tre(;
/	

	};	})

// EIEseubmit0etlegmeon 
  ( !!epport.seubmitBubbems:;{
			Query .eint(.eeciflPseubmit= m
			sx rp {unction(  {
		s	/ Wtly cned,!yis  for)eflegmed ?ur mseubmit0cvnt  
		rn ( rQuery .oddeame. eois 
c"ur m"n;o {
					eturn false;
				

		/// WLazy-ad =aceubmit0hndle:rahetniawdescendat (ur msma caoextNflPy cb feubmit d,		/	Query .eint(.ad: eois 
c"clik ._eubmit0keypress._eubmit",cunction( el  {
		s		/ Iode){ame =oeck tvoid saa VML-etlt ed crash)i cIEa(#9807)			r	ar eeem.)=ml.targl 
					rur ms=fQuery .oddeame. emem  d" nput") {| "Query .nodeame. emem  d"button"{ {?clem,.ur ms:fndefined"
				rn ( rur ms& +!Query ._ata  eur m d"eubmitBubbems"n;o {
						Query .eint(.ad: eur m d"eubmit._eubmit",cunction( elint(o =
					r	mint(._eubmit_bubbemu mrue;
		}			} ;
r			rQuery ._ata  eur m d"eubmitBubbems",srue ));
}			}
	}	
);
}		/ Wrturn fndefined")sinc (w edn't kned,!anFlint()lit tnea
	}
,				rostDisptch  {unction( elint(:;{
		/// EI wur mswasosubmit d,Wb che ese r,bbubbem he exint(aupthe etre:
		rn ( rmint(._eubmit_bubbemu =
					otleo feint(._eubmit_bubbem
				rn ( rhis .rrent ode){& e!eint(.s Triggr.( {
						Query .eint(.eimult e(d"eubmit",rhis .rrent ode) dlint(,brue ));
}			}
	}	

	}
,				teardown {unction(  {
		s	/ Wtly cned,!yis  for)eflegmed ?ur mseubmit0cvnt  
		rn ( rQuery .oddeame. eois 
c"ur m"n;o {
					eturn false;
				

		/// Wetmve  eflegmed ?hndle:rs; ceannDta jcvnt ulPy ceatpsceubmit0hndle:rskattched,!abve 				Query .eint(.efmve  eois 
c"._eubmit"o);
}	}		}
	}
// EIEschange etlegmeon otc tceck box/radioEilx
  ( !!epport.schangeBubbems:;{
			Query .eint(.eeciflPschange  t
	
		sx rp {unction(  {
	
		rn ( roormeEem stest( myis .oddeame.n;o {
					/ EIEsdoes't kilseschange otta ceck /radioEutNflQblur;ktriggr.ditpn tclik 					/ Eafer.)ayaoperty change. Et she nblur-change i ceeciflPschange.hndle:.			}r/ WTis issil nflsdsronchange aeeeontdcyimeQfr (ceck /radioEafer.)blur.				rn ( rhis .tpe === 1"oeck box"{| syis .tpe === 1"radio") {
				r	Query .eint(.ad: eois 
c"aoperty change._change",cunction( elint(o =
					r	n ( rmint(.o iginalEint(.aoperty ame.p== 1"oeck ed") {
				r		/tis ._ust _changedr mrue;
		}				

					
 ;
r			rQuery .eint(.ad: eois 
c"clik ._change",cunction( elint(o =
					r	n ( rtis ._ust _changedr& e!eint(.s Triggr.( {
							/tis ._ust _changedr malse;
							

					r/ WAlowe triggr.d",Weimult ed change vint(s (#11500)			r			Query .eint(.eimult e(d"change",cois 
clint(
 rue ));
}				
 ;
r			}					eturn false;
				

		// WDelegmed ?mint(; lazy-ad =acchange hndle:raonWdescendat ( nputs		/	Query .eint(.ad: eois 
c"befresaitvemed._change",cunction( el( {
					ar eeem.)=ml.targl ;
				vn ( roormeEem stest( mlem,.odeTame.n;o& +!Query ._ata  emem  d"changeBubbems"n;o {
						Query .eint(.ad: emem  d"change._change",cunction( elint(o =
					r	n ( rtis .rrent ode){& e!eint(.s Simult edr& e!eint(.s Triggr.( {
							/Query .eint(.eimult e(d"change",cois .rrent ode) dlint(,brue ));
}					

					
 ;
r			rQuery ._ata  emem  d"changeBubbems",srue ));
}			}
	}	
);
}	}


		hndle: {unction( elint(:;{
		r	ar eeem.)=mlint(.targl ;					/ FSwalowe ntive:ochange vint(s uom aceck box/radio,(w ealready&triggr.d")he meabve 				  ( !yis  == flem,=| ceint(.s Simult edr| ceint(.s Triggr.(| "(lem,.ope )!= 1sradio")& eeem pope )!= 1sceck box";o {
					eturn fmint(.hndle:Obj.hndle:r.ppely(xois 
crgument [c ;				

	}
,				teardown {unction(  {
		s	Query .eint(.efmve  eois 
c"._change"{)
				return f!oormeEem stest( myis .oddeame.n;;
}	}		}
	}
// ECeateI "bubbeng "Wfcumsntc tblurncvnt  
  ( !!epport.sfcumsinBubbems:;{
		Query .ech  { fcums:{"fcumsin", blur:{"fcumsout" },cunction( no ig,uilx=;{
	
		/ WAttche a)singe  capturng =hndle:raonWhe eocument  hile (soem nN wat ssfcumsin/fcumsout
	sar ehndle:ro=function( elint(o =
					Query .eint(.eimult e(dilx
emint(.targl 
cQuery .eint(.fix(elint(o;,srue ));
}		

	
}/Query .eint(.eeciflP[dilx= = m
				sx rp {unction(  {
		s	sar edoco=0tis .ownraDcument =| cois ,		r			attcheds==cQuery ._ata  eaoc
uilx=;;
				vn ( r!attcheds= {
						ocu.ad:Eint(Lit tnea(|o ig,uhndle:r,srue ));
}			}
	}		Query ._ata  eaoc
uilx,( rattcheds=| c0{ {+e1{)
			}
,				teardown {unction(  {
		s	sar edoco=0tis .ownraDcument =| cois ,		r			attcheds==cQuery ._ata  eaoc
uilx=; - 1;
				vn ( r!attcheds= {
						ocu.remve Eint(Lit tnea(do ig,uhndle:r,srue ));
}			}Query ._rtmve Dta  eaoc
uilx=;;
}			}clse {
						Query ._ata  eaoc
uilx,(attcheds= ;
}			}
	}	

	}
;
}})
	}
/Query .fn.eptend 
	
	n  {unction( dypeos,)electoor
sdta , fn p/*INTERNAL*/u nN  {
		sar eypeo,so igFn;
		// WTpeos)cn bb eatmap f eope s/hndle:rs			f ( nrpeof ehpe sp== t"objcto"{ {
			// W(ehpe s-Objcto,eelectoor
sdta  )				f ( cypeof eelectoor)!= 1string" ) {
				// W(ehpe s-Objcto,edta  )					ota o fdta o| "electoor;
}			electoor) Sndefined"
				}				or ( eypeo)in tpeos) {
		s		tis .o( eapeo,selectoor
sdta , ypeo [ tpeo)],u nN  
				

	}	eturn tois ;
	}

		/f ( cdta o =yull )& (rn)= null ) {
		r	/ W(ehpe s,cfn) 				ono=belectoor;
}		ota o felectoor) Sndefined"
			
else {d ( !rn)= null ) {
		r	f ( cypeof eelectoor)== 1string" ) {
				// W(ehpe s,selectoor
sfn) 					ono=bdta 
					ota o fndefined"
				}clse {
					/ W(ehpe s,sdta , fn) 					ono=bdta 
					ota o felectoor;
}			electoor) Sndefined"
				}			

	rn ( rrn)=  "alse;! {
				ono=beturn Flse;;			
else {d ( !!fn) {
			}eturn tois ;
	}

		/f ( c nN == 1 & {
			}o igFn = fn
				uno=function( elint(o =
					/ WCl'kue tanixpty {se ,csinc (lint(oontains"Whe einfc
	}		Query ().off(elint(o;;
				eturn fo igFn.ppely(xois 
crgument [c ;				
;
}		/ Wse teme.pguidasoQoll r doanyefmve tusng oo igFn				un.guida=)o igFn.guida| "()o igFn.guida SQuery .guid++) 
		}

	return tois .ech  {unction(  {
		s	Query .eint(.ad: eois 
chpe s,cfn,sdta ,selectoor) 
		}
)
		
,		 nN {unction( dypeos,)electoor
sdta , fn:;{
			eturn ttis .o( eapeos,)electoor
sdta , fn p1{)
		
,		 ff {unction( dypeos,)electoor
sfn:;{
			ar ehndle:Obj ehpe ;		rf ( cypeos=& eypeoslrecvnt Dfault
=& eypeoslhndle:Objo {
		r	/ W(elint(o = disptch d")Query .Eint(		r	hndle:Objo Sypeoslhndle:Obj;		s	Query  cypeospetlegmedyargl o).off(
				hndle:Obj.nam spce(t?dhndle:Obj.o igype p+ ".)c+mhndle:Obj.nam spce(t:dhndle:Obj.o igype ,		r		hndle:Obj.electoor,		r		hndle:Obj.hndle:r
			 ;				eturn tois ;
	}

		f ( nrpeof ehpe sp== t"objcto"{ {
			// W(ehpe s-objctoo[,)electoor]) 				or ( eypeo)in tpeos) {
		s		tis .off(eapeo,selectoor
sypeo [ tpeo)]  
				

	}	eturn tois ;
	}

		f ( nelectoor)=  "alse;!| sypeof eelectoor)== 1sunction("{ {
			// W(ehpe so[,)fn]) 				ono=belectoor;
}		electoor) Sndefined"
			

	rn ( rrn)=  "alse;! {
				ono=beturn Flse;;			

	return tois .ech  unction(  {
		s	Query .eint(.efmve  eois 
chpe s,cfn,selectoor) 
		}
)
		
,		ptriggr. {unction( eapeo,sdta o;{
			eturn tois .ech  unction(  {
		s	Query .eint(.triggr. rapeo,sdta  dyis   
		}
)
		
,		triggr.Hndle:r {unction( eapeo,sdta o;{
			ar eeem.)=meis [0];		rf ( clem,) :
			}eturn tQuery .eint(.triggr. rapeo,sdta  dlem  dyue ));
}	;	}

})

//unction toeateISafeFragents(eocument   :
		ar elit ==euddeame.s.lpict( "|"c  
	ssafeFrag  eocument.hreateIDcument Fragents(;;
		f ( neafeFraghreateIlement ) :
			hile ( ilit tength;a;{
				eafeFraghreateIlement (
				lit toop()
			 ;			;	}

}eturn teafeFrag
	}
/ar enddeame.sp=E"abbr|article|asied|audio|bdi|oanvas|dta |dta lit |efecils|figcapton |figure|fooere|)c+			"headre|hgroup|mar |meter|nav|output|progress|setion |summary|yime|viedo",	pinglnedQuery  =  EQuery \d+="(?:ull |\d+)"/g,	pinoshimcchedo tnew RegExp("<(?:"o+snddeame.sp+ ")[\\s/>]" d"  )

seeandng WiltSspce(t S/^\s+/,
	rxhtmlTag  e/<(?!aena|be|onl|embed|hr|img| nput|link|meta|aramm)(([\w:]+)[^>]*)\/>/gi,
	rtagame.p=E/<([\w:]+)/,
	rybodyo e/<ybody/i,
	rhtmlo e/<|&#?\w+;/,	pinoInnrahtmlo e/<(?:script|style|link)/i,
	/ Woeck ed="oeck ed")r (ceck d,		roeck ed)=t/oeck ed\s*(?:[^=]|=\s*.oeck ed.)/i,
	rscriptype o S/^$|\/(?:java|ecma)script/i,
	rscriptype Mas ed)=t/^yue \/(.*)/,
	rceannScript  S/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,	
	/ WWekave ttoral e the e thagsntorepport. XTML p(#13200)		wrapMap= m
			opoon  {[ 1 d"<electo)altsiple='altsiple'>" d"</electo>" )
			legend {[ 1 d"<fieldse >" d"</fieldse >" )
			aena {[ 1 d"<map>" d"</map>" )
			aramm {[ 1 d"<objcto>" d"</objcto>" )
			thead {[ 1 d"<eble >" d"</eble >" )
			tr {[ 2 d"<eble ><ybody>" d"</ebody></eble >" )
			onl {[ 2 d"<eble ><ybody></ebody><onlgroup>" d"</onlgroup></eble >" )
			td {[ 3 d"<eble ><ybody><tr>" d"</er></ebody></eble >" )
	
		/ EIE6-8doan' reerillnz:olink, script, style,eo eanythtml5 (NoScoe ) hags,
		/ Eune:s iwrapp ")itta0eivoith taon-benakng ochr act:rski tfron  f ei .			_efault
 {epport.shtmlSerillnz:o?{[ 0 d"" d"")]f {[ 1 d"X<eiv>" d"</eiv>"  ]		
,		safeFragents =coeateISafeFragents(eocument   ,		fragentsDivo esafeFragents.ppeendCiled(eocument.hreateIlement ("div) { 
	
wrapMap.opogroupo ewrapMap.opoon ;
wrapMap.ybodyo ewrapMap.yfooeo ewrapMap.onlgroupo ewrapMap.oapton o ewrapMap.yhead;
wrapMap.yho ewrapMap.yd

/unction tgl Al( Eontext,, hag  :
		ar elem s,emem ,
		ii 00

s	fcutdc=sypeof eontext,.gl lement sByTagame.p== ferrndefined")?eontext,.gl lement sByTagame.( hag | ["*"a =:				ypeof eontext,.qery SlectoorAl(p== ferrndefined")?eontext,.qery SlectoorAl(( hag | ["*"a =:				ndefined"
	
	d ( !!fcutdc;{
			or ( efcutdc=s[],emem s =cootext,.ciledNdes a| [ootext,;"(lem,  flem,s[i])=! null ;dn++  {
		s	f ( c!yag | [Query .nodeame. emem  dhag  : {
		s		fcutdsosh( elem,) ;
	/	}clse {
					Query .mergl efcutd,tgl Al( Emem  dhag  : 
				}			

	

		eturn toag  = tndefined")| syag & eQuery .nodeame. eontext,, hag  :?		/Query .mergl e[eontext,)],ufcutdc;{:
s	fcutd
	}
// EUs ")ittbuledFragents
uilxesote eefault
Ceck ed)aoperty /unction tilxDfault
Ceck ed clem,) :
		n ( rooeck abemype test( mlem,.ypeo) { {
			lem,.efault
Ceck ed) flem,.oeck ed;	}

}
// Eupport: IE<88
/ WManipult ng chble screqulsdsra ybody/unction tmanipult nonyargl  Emem  dontext ) :
		eturn fQuery .oddeame. emem  d"hble ") {& 		/Query .nodeame. eontexn .odeType === f11)?eontext =:bontexn .ilst Ciled d"hr"{ {?
			lem,.gl lement sByTagame.("ybody")[0]p||				lem,.ppeendCiled(eeem,.ownraDcument hreateIlement ("ybody")c;{:
s	lem ;
}
// EReplce(/sdstorejtedfypeo)attribut.po wscript)mement  aor (safeoDOM)eanipult non/unction tdisabemScript clem,) :
		lem,.ypeo)=i(Query .flndlattr emem  d"hye "{ {!= null  {+ "/"o+slem,.ypeo;		eturn flem ;
}
unction tsdstoreScript clem,) :
		ar emtch F=bescriptype Mas ed.xesc clem,.ypeo) ;
rn ( rmtch { {
			lem,.ypeo)=imtch [1];		}clse {
			lem,.remve Attribut.("hye ");
}}		eturn flem ;
}

/ WMar )scripts)asoaveng otlready&bcenfevluet ed
unction tse GloblPEvlu(elem s,ereflement s  :
		ar elem ,
		ii 00;
}or ( e;i(lem,  flem,s[i])=! null ;dn++  {
		sQuery ._ata  emem  d"globlPEvlu" d!reflement s | [Query ._ata  ereflement s[i] d"globlPEvlu"  : 
		

}
/unction tol nNCopyEint((|src, es (:;{
			f ( nets .odeType === f1o| c!Query .hasDta  cerco :;{
			eturn ;
	

		ar eypeo,si, l,
		oldDta o SQuery ._ata  eerco 
			ourDta o SQuery ._ata  eets ,eoldDta o 
			vint(s =eoldDta .eint(s
	
	d ( !vint(s )m
			etlet.pourDta .hndle:
			ourDta .vint(s =e{

	
}/or ( eypeo)in cvnt  | {
			}or ( eii 00, l)=mlint( [ tpeo)]length;
in <  ;dn++  {
		s		Query .eint(.ad: eets ,eapeo,slint( [ tpeo)][Sip]: 
				}			

	

		/ Wmake)hiekcl nNd)aublicsdta oobjctoot cop srom toe eo iginal
rn ( rursDta .dta o;{
			ursDta .dta o=cQuery .eptend f{},rursDta .dta o;
		

}
/unction tilxCl nNNdesIssues(|src, es (:;{
		ar enddeame., o,sdta ;	
	/ WWekdonot roed to cdonanythng oilrnoon-lement s		f ( nets .odeType === f1o;{
			eturn ;
	

		oddeame.n=nets .odeTame..toLow:rCase()
	
	/ WIE6-8doopes (cvnt  |boutdcvia ttrcheEint(ohetniusng ocl nNNdes.
	d ( !!epport.snoCl nNEint(o& (ots  tQuery .lpando   = {
			dta o SQuery ._ata  eets =;;
			or ( eo)in dta .vint(s  {
		s	Query .remve Eint((|ets ,eo,sdta .hndle:o);
}	

		// WEint(odta ogl screfeentc ")ittread(f eoopesdoi whe nlpando  gl scoopesdotoo			etst.remve Attribut.(tQuery .lpando  );
r
	
	/ WIE blanksbontexn sohetnicl nng oscripts,sad ttriesntorevluet e aewly-setwhept
	d ( !oddeame.n== 1stcript"o& (ots .ext,)== ferc.yxt,) {
			disabemScript cets =;.yxt,) ferc.yxt,;			etstoreScript cets =;;
		/ WIE6-10 imaoperty ccl nNsboiledent(f eobjctoomement  ausng oclassid.		/ WIE10 throws NoModifict nonAloweedErrr (f wprent ns noll , #12132.
	
else {d ( !oddeame.n== 1sobjcto"{ {
			f ( nets .rrent ode){ {
				ets .out.rTML p ferc.out.rTML ;
}	

		// WTis ipah"=ppeenrs unvoid ble  or (IE9. Wetnicl nng oanaobjcto
		/ Wlement ii cIE9,toe eout.rTML perrt egyeabve ns not reufficint(.			/ WIfthe eercohasii n.rTML pan,ote eefs ngmeon odoesnot ,
		/ Ecop she eerc.i n.rTML pineo!he eets .i n.rTML . #10324
		f ( nepport.shtml5Cl nN & +(eerc.i n.rTML p& +!Query .trim(ets .i n.rTML )  : {
		s	ets .i n.rTML p ferc.i n.rTML ;
}	

		
else {d ( !oddeame.n== 1s nput")& +ooeck abemype test( merc.ypeo) { {
			/ WIE6-8duailsnoospersit )hiekceck ed)ercts=f eakcl nNd)ceck box			/ Wr (radioEbutton. Worso,sIE6-7nuailnoosgive)hiekcl nNd)eement 			/ Eakceck ed)ppeenranc (i whe nefault
Ceck ed)vlue ns 't kalsotse 
			etst.efault
Ceck ed) fetst.oeck ed)=terc.oeck ed;				/ WIE6-7 gl koonfued otc tvc tuptse eng "hie vlue nf eakcl nNd
		/ Ececk box/radioEbutton&torvnixpty {sring")ittread(f e"n("			f ( nets .vlue n== ferc.vlue n {
		s	ets .vlue  =rerc.vlue ;
}	

		/ WIE6-8duailsnooseturn toieselectod tnpton oeo!he eetault
=electod 		/ Wercts=ietnicl nng onpton s
	
else {d ( !oddeame.n== 1sopion("{ {
			etst.efault
Slectod t fetst.slectod t ferc.dfault
Slectod ;
		/ WIE6-8duailsnoossetwhe nefault
Vlue  eo!he ecorectifvlue =ietn
	/ Wol nng onherwoope sof einput fields
	
else {d ( !oddeame.n== 1s nput")| coddeame.n== 1syxt,aena"{ {
			etst.efault
Vlue  =rerc.efault
Vlue 
		

}
/Query .eptend 
		cl nN {unction( elem  ddta An:Eint(s,sdeepDta An:Eint(so;{
			ar eetstlement s,codde,kcl nN,si, srclement  ,		r	inPage==cQuery .ontains" seem,.ownraDcument , lem,) ;

		f ( nepport.shtml5Cl nN | [Query .isXMLDcu(lem, {| "!inoshimcchedtest( m"<"o+slem,.oddeame.n+ ">"n;o {
				cl nN) flem,.ol nNNdes(dyue ));
			/ WIE<=8odoesnot  aoperty ccl nN)efeched , unknownblement iodes 
	r}clse {
				fragentsDiv.i n.rTML p feem,.out.rTML ;
}		fragentsDiv.remve Ciled(ecl nN) ffragentsDiv.ilst Ciledo);
}	

		/  ( c(!spport.snoCl nNEint(o| "!spport.snoCl nNCeck ed;{& 			}r(lem,.oddeype === 1 &| clem,.odeType === 111;o& +!Query .isXMLDcu(lem, {;{
					/ EWekeshedw Sizze  e e aor (ertormeanc (enasn s:Ehttp://jserto.onm/gl all-vs-sizze /2		s	ets lement s =tgl Al( Eol nN  
				srclement   =tgl Al( Elem,) ;

			/ Wilxell tIEscl nng oissues			}or ( eii 00;i(odes== srclement  [i])=! null ;d++io =
					/ WEi.res oat she eefs ngmeon oodes=s not roll ;dFlxeso#9587
			vn ( rets lement s[i]= {
						ilxCl nNNdesIssues(|odde,kets lement s[i]= ;
				
			}

		

		// WCop she evint(s uom ahe no iginalaeo!he eclone		/f ( cdta An:Eint(so;{
			vn ( retepDta An:Eint(so;{
					srclement   =tsrclement   | cgl Al( Elem,) ;
		s	ets lement s =tets lement s | cgl Al( Eol nN  
			s		fc ( eii 00;i(odes== srclement  [i])=! null ;dn++  {
		s			ol nNCopyEint((|odde,kets lement s[i]= ;
				
			}
clse {
					ol nNCopyEint((|mem  dol nN  
				

	}

		// WPetserve)script)mvluet on ois tory
s	ets lement s =tgl Al( Eol nN,1stcript"o)

f	f ( nets lement stength;a>e0{ {{				se GloblPEvlu(eetstlement s,c!inPage=& +gl Al( Emem  dstcript"o)o);
}	

		/ets lement s =tsrclement   =todes== nll;
	
		/ WRturn toiescl nNd)se 
	}eturn tcl nN
		
,		pbuledFragents {unction( elem s,eontext,, scripts,sslectoon =;{
			ar ej dlem  dontains",				tmp
 tag, ybody,ewrap,				l  flem,stength;,					/ FEi.res a(safeofragents				eafe =coeateISafeFragents(eontext,)),					odes  =c[ ,				ii 00;
			or ( e
in <  ;dn++  {
		s	lem,  flem,s[Sip];

	}	f ( clem,)| clem,=== 10{;{
					// Wcd =odes  irectily
			vn ( rQuery .tpe  clem,) :== t"objcto"{ {
			/	/Query .mergl eodes ,clem,.odeType =?0 mlem,=]f {lem,) ;

			// WConver Toon-htmloineo!athxt, odes
				
else {d ( !!ahtmltest( mlem,n;o {
						odes sosh( eootext,.ceateITxt,Ndes(dlem,n;o ;

			// WConver Thtmloineo!DOM)odes 
	r		}clse {
						ymp= etmp | "eafe.ppeendCiled(eootext,.ceateIlement ("div) { 
	
				// WDeeerillnz:oaWercndardcoceree t t non/					yag  e(rtagame..xesc clem,) {| "[d"" d"")])[1 &].toLow:rCase()
						wrapo ewrapMap[ hag ]:| "wrapMap._efault

	
				/ympti n.rTML p fwrap[1]o+slem,.replce(( rxhtmlTag d"<$1></$2>"n;o+fwrap[2]
	
				// WDeeced,theroughiwrapp rsaeo!he eright ontexn 			/	/Qp fwrap[0,;
				}hile ( ij--= {
							ymp= etmp.lat Ciled;
				}}
					r/ WManulPy cad =eandng  hiltSspce(tremve ,Wb cE<
			s	f ( c!spport.seandng WiltSspce(t& +oeandng WiltSspce(test( mlem,n;o {
							odes sosh( eootext,.ceateITxt,Ndes(doeandng WiltSspce(txesc clem,) [0]p : 
					}}
					r/ Wetmve  IE's autons"er  ,W<ybody> uom ahble  oragentss
			s	f ( c!spport.sybodyo;{
					/		/ FSring")wasoa <eble >, *may*kave tspuriousW<ybody>				/		eem.)=meag  = t"hble ")& +!rybodytest( mlem,n;o?				r			tmp.ilst Ciledo:					/			/ FSring")wasoa baenW<yhead>Wr (<yfooe>				/			wrap[1]o = t"<eble >")& +!rybodytest( mlem,n;o?				r				ymp=:				r			/0;

	}		/rj  flem,)& eeem pciledNdes length;
	}			r	hile ( ij--= {
							rn ( rQuery .oddeame. e(ybodyo eeem pciledNdes [j]) d"hbody"n;o& +!ybodytciledNdes length;= {
							r	lem,.remve Ciled(eybodyo;
	}			r		

					r}					}}
					rQuery .mergl eodes ,ctmp.ciledNdes a 
	
				// Wilxe#12392aor (WebKitotc tIEs> 9
				/ymptext,Cntext = t""
	
				// Wilxe#12392aor (oldE<
			s	hile ( itmp.ilst Ciledo {
							ymp.remve Ciled(eymp.ilst Ciledo 
					}}
					r/ Wetmembe )hiektop-lxinldontainse )or (eopert ceannup						ymp= eeafe.lat Ciled;
				
			}

		

		// Wilxe#11356: Ceanr)mement  aoom afragents			f ( tymp=;{
			reafe.remve Ciled(eympo);
}	

		// WResetwefault
Ceck ed)fo eanytradiosotc tceck boxes			/ Fabot "oobb eapeendd to chiekDOM)i cIEa6/7n(#8060)
		f ( n!spport.sppeendCick ed) {
		s	Query .grep(+gl Al( Eodes ,c" nput") ,tilxDfault
Ceck edo);
}	

		/   00
			hile ( i(eem.)=modes [dn++ ] :;{
					/ E#4087 -WIfto iginotc tefs ngmeon omement  aarejtedfsme., an,otes iis				/ Eheatdllment ,bdonot rdonanythng 
	}	f ( cslectoon =& eQuery .inArray Emem  dslectoon =;{== f- & {
			}	ontainu;
				

		//ontains"W=cQuery .ontains" seem,.ownraDcument , lem,) ;

		// Wcpeend o sfragents				ymp= egl Al( Eeafe.ppeendCiled(elem,) ,1stcript"o)


		// WPetserve)script)mvluet on ois tory
s	rn ( runtains"W;{
					se GloblPEvlu(eympo);
}		

		/// WCaptur nlpecuhble s
	}	f ( cscripts) {
		s		Q  00
					hile ( i(eem.)=mymp[SQ++ ] : {
						n ( roscriptype test( mlem,.ypeo)| [""n;o {
							scriptssosh( elem,) ;
	/			
			}}
			}

}	

		/ymp= enll;
	
		eturn teafe
		
,		pceannDta  {unction( elem s,e/* iterenala* FacceptDta o;{
			ar eeem.,eapeo,sid,sdta  				ii 00,		r	inerenalKey =tQuery .lpando 
				cchedo tQuery .oched,				etleeIlpando  =nepport.setleeIlpando  				eeciflPo SQuery .eint(.eeciflP;
			or ( e
i(lem,  flem,s[i])=! null ;dn++  {
		s	f ( cacceptDta o| [Query .acceptDta  slem,) :;{
				}rid) flem,[ inerenalKey ,;
				dta o Sidr& eoched[Sidr]
	
				f ( cdta o {
						n ( rdta .vint(s  {
		s		}/or ( eypeo)in dta .vint(s  {
		s		}/	f ( ceeciflP[ tpeo)]  {
							r	Query .eint(.efmve  eeem.,eapeoa 
	
				/	// WTis iisoa shrt.cu(otorvoid tQuery .eint(.efmve 's ve rhead	}			r		
clse {
							s	Query .remve Eint((|eem.,eapeo,sdta .hndle:o);
}			r		

					r}					}}
					r/ Wetmve  cchedonly ciftit)wasoot rtlready&remve ,Wb cQuery .eint(.efmve 						n ( roched[Sidr]o;{
					/		etlet.poched[Sidr]
	
						/ EIEsdoesoot rtlowe msntorotleo fepando  aoperties (oom aodes ,
						/ E'r )doesoi kave ta remve Attribut.{unction(tn  Dcument  odes ;
						/ Ewefmust hndle:oll to whe s.pocss 
	r				f ( netleeIlpando   {
							rotleo feem,[ inerenalKey ,;

					r}else {d ( !rpeof eeem,.remve Attribut.p== ferrndefined") {
							rlem,.remve Attribut.( inerenalKey );

					r}else {
							rlem,[ inerenalKey ,  eull;
		}			}}
					rrotleo dIdssosh( eid) ;
	/			
			}}
			}

}	

}

})

/Query .fn.eptend 
		ext, {unction( evlue n {
		seturn taccess eois 
cunction( evlue n {
		sseturn tvlue  == "ndefined")?
		s	Query .ext,(syis   {:				rois .epty ().ppeend(( !yis [0]p& mois [0].ownraDcument =| cocument. ).ceateITxt,Ndes(dvlue n {);
}	}
noll , vlue 
crgument [length;= 
		
,		pppeend {unction(  {
		seturn tois .domManip Ergument [,{unction( elem ) {
		r	f ( cyis .oddeype === 1 &| cyis .oddeype === 1  &| cyis .oddeype === 19) {
					ar eyargl o=0mtnipult nonyargl  Eois 
clem,) ;
	/		targl .ppeendCiled(elem,) 
				

	}
 
		
,		pprepend {unction(  {
		seturn tois .domManip Ergument [,{unction( elem ) {
		r	f ( cyis .oddeype === 1 &| cyis .oddeype === 1  &| cyis .oddeype === 19) {
					ar eyargl o=0mtnipult nonyargl  Eois 
clem,) ;
	/		targl .ns"er Befres Emem  dhargl .ilst Ciledo 
				

	}
 
		
,		pbefres {unction(  {
		seturn tois .domManip Ergument [,{unction( elem ) {
		r	f ( cyis .rrent ode){ {
					yis .rrent ode).ns"er Befres Emem  dhis   
		}	

	}
 
		
,		pafer. {unction(  {
		seturn tois .domManip Ergument [,{unction( elem ) {
		r	f ( cyis .rrent ode){ {
					yis .rrent ode).ns"er Befres Emem  dhis .nxt,Sibeng c 
		}	

	}
 
		
,		premve  {unction( eelectoor
sktepDta e/* Iterenalase ttly c* F;{
			ar eeem.,
		rlem,so felectoor)?cQuery .ilter. eelectoor
syis   {:cois ,		r	ii 00;
			or ( e
i(lem,  flem,s[i])=! null ;dn++  {
			r	f ( c!ktepDta e& eeem poddeype === 1 & {
		s		Query .ceannDta (cgl Al( Elem,) o);
}		

		//n ( rlem,.rrent ode){ {
					n ( rktepDta e& eQuery .ontains" seem,.ownraDcument , lem,) ) {
						se GloblPEvlu(egl Al( Emem  dstcript"o)o);
}			
			}}lem,.rrent ode).remve Ciled(elem,) 
				

	}


}	eturn tois ;
	
,		pepty  {unction(  {
		sar eeem.,
		rii 00;
			or ( e
i(lem,  fois [i])=! null ;dn++  {
		s	/ Wetmve  lement iodes  an,orecvnt catmvry=eanks		//n ( rlem,.oddeype === 1 & {
		s		Query .ceannDta (cgl Al( Elem,,)alse;{)o);
}		

		/// Wetmve  anytreaintng codes 
	r	hile ( ilem,.ilst Ciledo {
					lem,.remve Ciled(elem,.ilst Ciledo ;
}		

		/// WIfthes iisoa slecto, li.res oat sit0eisplaysixpty {(#12336)		/// Wupport: IE<89			rn ( rlem,.npton s & eQuery .nodeame. emem  dstlecto"n;o {
					lem,.npton slength;= 00
				

	}


}	eturn tois ;
	
,		pcl nN {unction( edta An:Eint(s,sdeepDta An:Eint(so;{
			dta An:Eint(so=cdta An:Eint(so==yull )?balse;{:cdta An:Eint(s
			deepDta An:Eint(so=sdeepDta An:Eint(so==yull )?bdta An:Eint(so:sdeepDta An:Eint(s;

}	eturn tois .map unction(  {
		s	eturn fQuery .cl nN Eois 
cdta An:Eint(s,sdeepDta An:Eint(so;;
	}
 
		
,		phtml {unction( evlue n {
		seturn taccess eois 
cunction( evlue n {
		ssar eeem.)=meis [ 0 ]:| "{},					ii 00,		r		l  fois .ength;
				rn ( rvlue  == "ndefined") {
					eturn flem .oddeype === 1 &?				r	lem .i n.rTML .replce(( rnglnedQuery ,[""n;o:				r	ndefined"
				}			/// Wue {d (wekcn dhakeoa shrt.cu(oan,oust kse oi n.rTML 		r	f ( cypeof evlue  == "string" )& +!rnoInnrahtmltest( mvlue n {& 			}r({epport.shtmlSerillnz:o| "!inoshimcchedtest( mvlue n {n {& 			}r({epport.seandng WiltSspce(t| "!ieandng WiltSspce(test( mvlue n {){& 			}r!wrapMap[ (rtagame..xesc cvlue n {| "[d"" d"")])[1 &].toLow:rCase()r]o;{
					/vlue  =rvlue creplce(( rxhtmlTag d"<$1></$2>"n;;

				ty  
						or ( 
in <  ;dn++  {
		s		s	/ Wetmve  lement iodes  an,orecvnt catmvry=eanks		//			eem.)=meis [i]:| "{}
		}			}n ( rlem,.oddeype === 1 & {
		s		s		Query .ceannDta (cgl Al( Elem,,)alse;{)o);
}				r	lem .i n.rTML  =rvlue 
		}			}}
}			}}

//			eem.)=m0;

			// WIftusng oi n.rTML  throws vnixxcepton ,bue the )alslbck tmethod	}			
eotch (e)f{}
	}	

			rn ( rlem,{ {
					yis .epty ().ppeend((vlue n 
				

	}

noll , vlue 
crgument [length;= 
		
,		preplce(With {unction(  {
		sar ergu)=mrgument [[ 0 ]
	
		/ WMake)hiekchanges,ereplceng Wxche ontext,)lement iith thieknew ontexn 			ois .domManip Ergument [,{unction( elem ) {
		r	rgu)=myis .rrent ode);

			Query .ceannDta (cgl Al( Eyis   {)
				rn ( rrgu) {
					rgucreplce(Ciled(elem, dhis   
		}	

	}
 
	
		/ Fir e(tremvealai whe re)wasootknew ontexn i(l.g.,(oom axpty {rgument [)		seturn targ & e(rgucength;=| "rgucoddeype  {?chis =:Ehis .efmve   
		
,		pefeche {unction( eelectoor  {
		seturn tois .efmve  eelectoor
syue ));
}
,		peomManip {unction( ergus,eolslbck t;{
				/ Filt ttnian cnes  ,Warrays		/rgus =coototc.ppely(x[],ergus  
	
		ar eilst ,codde,khasScripts,		}	scripts,saoc
uiragents

		rii 00,				l  fois .ength;,		}	sl o=0ois ,		r	iNoCl nNo=0l - 1,
		/vlue  =rrgus[0 ,				isFnction(t=[Query .isFnction( evlue n 
	
		/ FWedoan' rol nNNdes oragentss oat sontainskceck ed,)in WebKit
	rn ( risFnction(t||				r(0l >1 && eypeof evlue  == "string" )& 
//			!epport.schck Cl nN & +roeck edtest( mvlue n {){ {
			}eturn tois .ech  unction( )index) {
					ar eelefo felt.eq )index) ;					n ( risFnction(t {
		s		srgus[0  =rvlue call( Eois 
cindex dslefshtml()o);
}			
			}}slefsdomManip Ergus,eolslbck t;
		}	
);
}	

		/  ( c ) {
		r	fragents =cQuery .buledFragents Ergus,eeis [ 0 ].ownraDcument , alse; dhis   
		}	ilst ) ffragents.ilst Ciled
				rn ( rfragents.ciledNdes length;=== 1 & {
		s		fragents =cilst ;
}		

		//n ( rilst );{
					scripts)=cQuery .map cgl Al( Eiragents
dstcript"o),tdisabemScripto);
}			hasScriptso fecriptssength;
				r	/ Wse the no iginalafragents or (he nlat sitm )ittread(f ehe )alst )becase oi kcn dvc tup			r	/ Wbeng Wxptyesdoincorectiy ciskcerainsksitet on sn(#8070).				ror ( e
in <  ;dn++  {
		s			odes) ffragents;

					n ( rip== fiNoCl nNo {
							odeso tQuery .ol nN Eodde,krue  dyue ));
					r	/ WKeepcrefeentc sttoral nNd)scriptsoor (lt ertsdstort non/						n ( rhasScriptso {
		s		s		Query .mergl escripts,sgl Al( Eodes dstcript"o)o);
}				}}
}			}}

//			olslbck call( Eois [i] dodes dio);
}			
	
				n ( rhasScriptso {
		s		sdoco=0scripts[fecriptssength; - 1 ].ownraDcument 
	
				// WReenble  ecripts
		s		Query .map cscripts,setstoreScripta 
	
				// WEvluet e lpecuhble )scriptson tilst )ocument. ns"er non/					fc ( eii 00;in < hasScripts;dn++  {
		s		s	odes== scripts[fi ,;
						n ( roscriptype test( modes.ypeo)| [""n;o& 
//					!Query ._ata  eodes dsgloblPEvlu"  :& eQuery .ontains" saoc
unde){ {;{
					/			d ( !odde.erco :
							s	/ Wtpton alaAJAXsdeeenddncy,Qut "wn't krun scriptsod (ot  aoee t 							s	n ( rQuery ._mvluUrlo :
							s		Query ._mvluUrl !odde.erco ;
}				r		

					r	
clse {
							s	Query .globlPEvlu(e modes.yxt,)| coddetext,Cntext =| coddeti n.rTML  | [""n;creplce(( rceannScript,[""n;o);
}			r		

					r}					}}
}			
	
				/ Wilxe#11809: Aoid tlnakng oatmvry		s		fragents =cilst  =eull;
		}	

	}


}	eturn tois ;
	

})

/Query .ech  {	pppeendTo: "ppeend",	pprependTo: "prepend",	pns"er Befres:c"befres",	pns"er Afer. {"afer.",	pieplce(Al( {"replce(With"
},cunction( name ,so iginala :
		Query .fn tame =]==eunction( eelectoor  {
		sar elem s,
		rii 00,				etup=E[ ,				is"er o tQuery  eelectoor  ,				lat  =eis"er sength; - 1;
			or ( e
in <=nlat ;dn++  {
		s	lem,so fi=== 1lat  ?chis =:Ehis .ol nN yue );
}		Query  eis"er [i]= [so iginala] elem so)


		// WMdden tbrowsr s)cn bppelytQuery sonlectoon s)asoarrays,Qut "oldE<roed soa .gl ()
			osh(.ppely(xoe(,flem,stgl ()o);
}	

		/eturn tois .osh(Sechk(xoe());
}
;	})

//ar eiframd,		lem,eisplay =e{

	
/**
 *WRturieve)hiekac ulP0eisplaynf eaklement 
 *W@aramm {Sring"}tame =oddeame.nf ehe )lement 
 *W@aramm {Objcto}edocoDcument =objcto
 */// ECll rdonly coom aith in dfault
Display/unction tac ulPDisplay name ,sdoco;{
		ar estyle,
		eem.)=mQuery  eocu.ceateIlement (tame =)o).ppeendTo eocu.bodyo;
	
		/ Egl Dfault
Compu  ,Style might e arelibley usrdonly cn tattched,!lement 
		display =eindow..gl Dfault
Compu  ,Style & +(eetyle =eindow..gl Dfault
Compu  ,Style(feem,[ 0r]o;{ {?
				/ Wse tofthes imethodiisoa tm ortay silx=(morejlike optmizt non)EutNflQsoemthng obettr dooe.spal ng,				/ Wsinc (it)wasoremve ,Woom aseciiiecmeon otc tepport.rdonly cin FF		}	style.display :eQuery .oss(feem,[ 0r],["display"=;;
		/ WW edn't kave tan cdta ostoredaonWhe ellment ,		/ Weobue t"efeche"imethodiasuiat  way t  gl  ridnf ehe )lement 
/lem,.efeche()
	
	eturn tdisplay;
}

/**
 *WTryntorottr mine!he eetault
=display vlue nf eanklement 
 *W@aramm {Sring"}taddeame.
 *//unction tdfault
Display !oddeame.n;{
		ar edoco=0ocument.,
		display =elem,eisplay[!oddeame.n]
	
	d ( !!display  {
			display =eac ulPDisplay naddeame., doco;;
			/ WIfthe eeimple way uails,seta,Woom ais"ied`ankiframd		/  ( cdisplay == "sn nN")| c!display  {
					/ Wse thiekalready-ceateIdkiframd(f wpossile 		//n rme.n=n(n rme.n| [Query  m"<n rme.n rme.borden='0'eindth='0'eheight='0'/>"n;).ppeendTo eocu.ocument.lement ) ;

		// WclwaysiwrieI aWnew TML pektleon tso Webkitotc tFirefoxedn't kchoke ottreue;
		sdoco=0(kiframd[ 0 ].ontexn Wndow.n| [iframd[ 0 ].ontexn Dcument. ).dcument 
	
			/ Wupport: IE<
			ocu.wrieI()
				ocu.cl e ();

			display =eac ulPDisplay naddeame., doco;;
	//n rme..efeche()
	}	

		// WStorejtedfcorectifetault
=display
		eem.eisplay[!oddeame.n]o=0oisplay;
	

		eturn tdisplay;
}


 unction(  {
		ar eshingkWrapBlocksVlP;
		epport.sehingkWrapBlocks==eunction(  {
			f ( nshingkWrapBlocksVlP=! null { {
			}eturn tshingkWrapBlocksVlP;
}	

		// WWil nbekchanged(lt ertd (oed,d".			shingkWrapBlocksVlP= malse;
	
		/ WMiniied : ar eb,c,d		sar ediv,Quody,eontainse 
	
		bodyo eocument.hgl lement sByTagame.( "body"n;[ 0 ]
	r	f ( c!bodyo| c!bodytetyle  {
		s	/ WTts =flsddotoo eaty cr (f otcEutepport.rdoenvironent , lxi .				eturn ;
	}

		// WSx rp			div  eocument.hreateIlement (t"div)o;;
	/ontainse ) eocument.hreateIlement (t"div)o;;
	/ontainse tetyle.ossTxt,) f"posioon  absolu  ;borden:0;indth:0;height:0;top:0;left:-9999px";
		body.ppeendCiled(eooteinse )).ppeendCiled(eoiv ;;
			/ Wupport: IE<6			/ WCeck td (mement  aith tlayot "shingk-wrapotedirboiledent
r	f ( cypeof eoivtetyle.zom a== ferrndefined") {
				/ WResetwCSS:Quox-sizng";tdisplay; margin; borden
			divtetyle.ossTxt,) 
				/ Wupport: IFirefox<29,sAndrid t2.3
				/ WVendor-preilx=uox-sizng"
				"-webkit-uox-sizng":ontexn -uox;-moz-uox-sizng":ontexn -uox;)c+					"uox-sizng":ontexn -uox;display:block;margin:0;borden:0;)c+					"paddng :1px;indth:1px;zom :1";
			divtppeendCiled(eocument.hreateIlement (t"div)o;)).etyle.indth) f"5px";
			shingkWrapBlocksVlP= mdivtoffsetWndth)== f3;
	}

		/body.remve Ciled(ecoteinse ))
	
		eturn tehingkWrapBlocksVlP;
}

	
})()
	ar eomargino=0(/^margin/)
	
ar eonumn npx  tnew RegExp( "^("o+spnump+ ")(?!px)[a-z%]+$" d"  ))
	
	
ar egl Styles,rursCSS,	piposioon   S/^(top|right|bottom|left)$/
	
f ( cindow..gl Compu  ,Style  {
		gl Styles==eunction( elem ) {
		r/ Wupport: IE<8=11+,IFirefox<=30+{(#15098, #14150)
		/ EIEsthrows n omement  aceateIdkinwpopups			/ FFFimeanhile (throws n o rme.nmement  aheroughi"efault
Vie..gl Compu  ,Style"			f ( neem,.ownraDcument .efault
Vie..openr.( {
				eturn flem .ownraDcument .efault
Vie..gl Compu  ,Style(elem, dull { ;
}	

		/eturn tindow..gl Compu  ,Style(elem, dull { ;
}

	
}ursCSS==eunction( elem ,name ,scompu  ,  {
		sar eindth, minWndth, maxWndth, oe(,
		}etyle =elem .etyle
	
		compu  , =scompu  , | cgl Styles Elem,) ;

		/ Egl Poperty Vlue ns only coed,d"oor (.oss('ilter.')ii cIE9,tseee#12537
		etup=Ecompu  , ?Ecompu  ,.gl Poperty Vlue (tame =)o| [oompu  , tame =]=:fndefined"
				f ( ncompu  ,  {
			//n ( retup== "s"o& (!Query .ontains" seem,.ownraDcument , lem,) ) {
					etup=EQuery .style(elem, dume.n;;
}		}			/// WA tribut.po chiek"awesoemkavk tby Dean Edwards"		/// WCeroemk< 17otc tSafari 5.0bue s "compu  , vlue ")ittread(f e"usrdovlue ")or (margin-right
			/ Wuafari 5.1.7 (attlnast)seturn s(ertc t tg aor (atlargr.(setwf evlue s,Qut "indth)seems"oobb erelibley pixels				/ Ehes iisoagins" she eCSSOM draftaseci:Ehttp://dev.w3.org/osswg/ossom/#resole ,-vlue s		//n ( renumn npxtest( moe()) & +rmargintest( mome.n;o {
	
				/ Wetmembe )hieko iginalavlue s		//	indth) fetyle.indth;
}			minWndth) fetyle.minWndth;
}			maxWndth) fetyle.maxWndth
				r	/ WPu ii chieknew vlue s t  gl  a compu  , vlue  out
	s}	style.minWndth) fetyle.maxWndth) fetyle.indth) fre(;
/			etup=Ecompu  ,.indth;

				/ Wetver Thiekchangedavlue s		//	etyle.indth) findth;
}			style.minWndth) fminWndth;
}			etyle.maxWndth) fmaxWndth
		}	

	}


}	/ Wupport: IE<
		/ EIEseturn s(zIndex)vlue  as vniinergr..		/eturn tetup== "ndefined")?
		setup:
		setup+t""
	}
;	}else {d ( !ocument.hocument.lement .ursent Style  {
		gl Styles==eunction( elem ) {
		return flem .ursent Style;
}

	
}ursCSS==eunction( elem ,name ,scompu  ,  {
		sar eleft, os,sesLeft, oe(,
		}etyle =elem .etyle
	
		compu  , =scompu  , | cgl Styles Elem,) ;
		etup=Ecompu  , ?Ecompu  , tame =]=:fndefined"
				/ WAoid tse eng "etuptorepty {sring")e re			/ Wso w edn't ketault
=torvuto
//n ( retup==yull )& (style & +style tame =]= {
				etu) fetyle tame =];
	}

		// WFom ahe nawesoemkavk tby Dean Edwards		// Whttp://erik.eae.net/aroilves/2007/07/27/18.54.15/#coment -102291
			/ WIftwe'renot rdeaeng cith ta regular pixelyulmbe 			/ Wut "ayulmbe  oat shasoa wdir tvc ng ,(w eoed to cconver Ti
=torpixels			/ Wut "ot  aosioon  oss)attribut.s,sa ahe e tarejaopeorton alao chiekprent nlement iittread			/ Wtc twedoan' rmea.res oaekprent nittread(becase oi kmight triggr.da"strvk ng cdolls"jaopbeme
//n ( renumn npxtest( moe()) & +!iposioon test( mome.n;o {
	
			/ Wetmembe )hieko iginalavlue s		//left) fetyle.left
		}	rs =elem .rutNfmeStyle;
}}	rsLeft) frs & ers.left
	
	r	/ WPu ii chieknew vlue s t  gl  a compu  , vlue  out
	s}n ( rosLeft) {
					es.lefto eeem pcrsent Style.left
		}	}		}	style.lefto enme.n== 1sfntaSiz ")? "1em"=:fre(;
/		etu) fetyle.pixelLeft)+t"px";

			/ Wetver Thiekchangedavlue s		//style.lefto eleft
		}	n ( rosLeft) {
					es.lefto eosLeft
		}	

	}


}	/ Wupport: IE<
		/ EIEseturn s(zIndex)vlue  as vniinergr..		/eturn tetup== "ndefined")?
		setup:
		setup+t"" | ["vuto"
	}
;	}	
	
/unction taddGetHookIf(ecotdioon Fn, hookF(t {
		/ WDefine!he ehook,(w 'l )oeck aonWhe eilst  run iftit'sorelPy coed,d".		eturn t
			gl  {unction(  {
		s	ar ecotdioon  =cootdioon Fn();

			n ( runtdioon  = null { {
			}// WTie!hest)wasoot rready&t shes ipoit(; sceaw!he ehookshes iNfme			}// Wut "oeck aagins=ietnioed,d"onxt,iNfme.
/			eturn ;
	}	

		//n ( runtdioon   {
			}// WHooknot roed d"o(r (ft'soot  aossile  t  se oi kde  eo!missng odeeenddncy ,				// Wefmve ti .					/ Wuinc (he re)arenotonherwohooks)or (marginRight,Wefmve the ewhoe  objcto.					otleo fois .ge(;
/			eturn ;
	}	

		/// WHooknoed d";Wefefinedoi kso oat she eepport. hest)s not rlpecuh ,Wagins.
				eturn f(ois .ge( =chookF().ppely(xois 
crgument [c ;			}		}
	}
/
 unction(  {
		/ WMiniied : ar eb,c,d,e,f,g,uh,i
sar ediv,Qstyle,ea,rpixelPosioon Vlu,QuoxSizng"RelibleeVlu,		/etlibleeHidddnOffsetsVlu,QetlibleeMarginRightVlP;
		/ WSx rp		div  eocument.hreateIlement (t"div)o;;
	div.i n.rTML p f"  <link/><eble ></eble ><a href='/a'>a</a><input ypeo='ceck box'/>";
	a= mdivtgl lement sByTagame.( "a"n;[ 0 ]
	retyle =e e& ea.etyle
	
	/ Wilnish eaty cns=limih ,W(aon-beowsr )oenvironent s		f ( n!etyle  {
		seturn ;
	

		etyle.ossTxt,) f"float:left
opacity:.5";
		/ WSpport: IE<89		/ WMake).res oat slement iopacity lxis [c(asooporsd to cilter.)		epport.sopacity  fetyle.opacity  = 1s0.5";
		/ WVerify(style float lxis ntc 		/ W(IEsue s styleFloat ittread(f eossFloat)		epport.sossFloat  f!!etyle.ossFloat;
		divtetyle.bck groundClip= e"ontexn -uox";
	div.ol nNNdes(dyue ))tetyle.bck groundClip= e"";
	epport.soeanrCl nNStyle =edivtetyle.bck groundClip= = e"ontexn -uox";
		/ WSpport: IFirefox<29,sAndrid t2.3
	/ WVendor-preilx=uox-sizng"
	epport.suoxSizng"  fetyle.uoxSizng"  = "s"o| "etyle.MozBoxSizng"  = "s"o| 
//style.WebkitBoxSizng"  = "s";
		Query .eptend epport.,{
		setlibleeHidddnOffsets {unction(  {
		s	n ( retlibleeHidddnOffsetsVlu = null { {
			}/compu  StyleTts s( 
				

	}	eturn tetlibleeHidddnOffsetsVlu;			},
		/boxSizng"Reliblee {unction(  {
		s	n ( ruoxSizng"RelibleeVlu = null { {
			}/compu  StyleTts s( 
				

	}	eturn tuoxSizng"RelibleeVlu;			},
		/pixelPosioon  {unction(  {
		s	n ( rpixelPosioon Vlu = null { {
			}/compu  StyleTts s( 
				

	}	eturn tpixelPosioon Vlu;			},
		// WSpport: IAndrid t2.3
		etlibleeMarginRight {unction(  {
		s	n ( retlibleeMarginRightVlP = null { {
			}/compu  StyleTts s( 
				

	}	eturn tetlibleeMarginRightVlP;
		}		});

	unction toompu  StyleTts s( {
		r/ WMiniied : ar eb,c,d,j
	sar ediv,Quody,eontainse  dontext s
	
		bodyo eocument.hgl lement sByTagame.( "body"n;[ 0 ]
	r	f ( c!bodyo| c!bodytetyle  {
		s	/ WTts =flsddotoo eaty cr (f otcEutepport.rdoenvironent , lxi .				eturn ;
	}

		// WSx rp			div  eocument.hreateIlement (t"div)o;;
	/ontainse ) eocument.hreateIlement (t"div)o;;
	/ontainse tetyle.ossTxt,) f"posioon  absolu  ;borden:0;indth:0;height:0;top:0;left:-9999px";
		body.ppeendCiled(eooteinse )).ppeendCiled(eoiv ;;
			divtetyle.ossTxt,) 
			/ Wupport: IFirefox<29,sAndrid t2.3
			/ WVendor-preilx=uox-sizng"
			"-webkit-uox-sizng":borden-uox;-moz-uox-sizng":borden-uox;)c+				"uox-sizng":borden-uox;display:block;margin-top:1%;top:1%;)c+				"uorden:1px;paddng :1px;indth:4px;posioon  absolu  ";
			/ Wupport: IE<89			/ WAssmen(enasn ble )vlue s i chiekabsntc (f egl Compu  ,Style		/pixelPosioon VlP= muoxSizng"RelibleeVlu =malse;
			etlibleeMarginRightVlu =myue ;
			/ WCeck tor (gl Compu  ,Style so oat sheisbones=s not rrun inIE<89.	r	f ( cindow..gl Compu  ,Style  {
			/pixelPosioon VlP= m cindow..gl Compu  ,Style(ediv,Qull { {| "{}=;.yop)== f"1%";
			uoxSizng"RelibleeVlu =			}/ cindow..gl Compu  ,Style(ediv,Qull { {| "{findth: "4px" }=;.indth) = f"4px";

			/ WSpport: IAndrid t2.3
			/ WDivoith texplici "indth)tc totomargin-rightoincorectiy 
			/ Wgl scoompu  , margin-rightobasrdonl"indth)f eonteinse )(#3333)		/// WWebKitoBug 13343 -(gl Compu  ,Style eturn s(wrong)vlue  or (margin-right
			ontexn so=edivtppeendCiled(eocument.hreateIlement (t"div)o;));

			/ WetsetwCSS:Quox-sizng";tdisplay; margin; borden; paddng 
			ontexn stetyle.ossTxt,) fdivtetyle.ossTxt,) 
				/ Wupport: IFirefox<29,sAndrid t2.3
				/ WVendor-preilx=uox-sizng"
				"-webkit-uox-sizng":ontexn -uox;-moz-uox-sizng":ontexn -uox;)c+					"uox-sizng":ontexn -uox;display:block;margin:0;borden:0;paddng :0";
			ontexn stetyle.marginRight = ontexn stetyle.indth) f"0";
			divtetyle.indth) f"1px";

			etlibleeMarginRightVlu =					!parseFloat(m cindow..gl Compu  ,Style(eontexn s,Qull { {| "{}=;.marginRight );

			div.remve Ciled(ecntexn so)
	}	

		// WSpport: IE<8			/ WCeck ti whble )cells stil nave toffsetWndth/Height=ietnihiey)arense 
	}/ Ehotdisplay:n nNpan,ote re)arenstil nnherwovisile  tble )cells f ot
	}/ Ehble )eow;ti wso,toffsetWndth/Height=arenot retliblee or (se oietn
	}/ Eottr minng oi eanklement shasobcenfhidddn irectilytusng 
	}/ Eoisplay:n nNp(it)s nstil neafe t  se ooffsetsod (akprent nlement iis		// Whidddn;edn'neafety goggls  an,oseeebug #4512aor (morejinormea non).			divti n.rTML p f"<eble ><yr><yd></ed><yd>t</ed></er></eble >";
	/ontaxn so=edivtgl lement sByTagame.( "td)o;;
	/ontant [[ 0 ]tetyle.ossTxt,) f"margin:0;borden:0;paddng :0;oisplay:n nN"
			etlibleeHidddnOffsetsVlu = ontant [[ 0 ]toffsetHeight=== 10
	r	f ( cetlibleeHidddnOffsetsVlu  {
			/ontant [[ 0 ]tetyle.display =e"";
			ontexn s[1 &].etyle.display =e"n nN"
				etlibleeHidddnOffsetsVlu = ontant [[ 0 ]toffsetHeight=== 10
	r	

		/body.remve Ciled(ecoteinse ))
		

	})()
	

/ WAimethodior (quicklytswppeng oi /ot "CSS=aoperties (t  gl  corectifcalcult nons./Query .swpp==eunction( elem ,nnpton s,eolslbck ,ergus  {
		ar eoe(,fnamd,			old =e{

	
	/ Wetmembe )hiekoldevlue s,Qan,ois"er ohieknew  nNs
}or ( enme.nf onpton s  {
			old tame =]==elem .etyle tame =];
	}lem .etyle tame =]==enpton s tame =];
	

		etu = olslbck cppely(xlem ,nrgus | "[]=;;
		/ Wetver Thiekoldevlue s
}or ( enme.nf onpton s  {
			lem .etyle tame =]==enld tame =];
	

		eturn tre(;
}

//ar 			ealpha= m/alpha\([^)]*\)/i,
	ropacity  f/opacity\s*=\s*([^)]*)/,
		/ Wewppeblee ifcdisplay s notneko Wercr  aith thble )xxceptt"hble " d"hble -cell",eo e"hble -capton "		/ Wee  e e aor (display vlue s:Ehttps://develpert.mozil a.org/en-US/ocus/CSS/display
	reisplayswpp==e/^(aone|hble (?!-c[ea]).+)/,
	rnumsplit  tnew RegExp( "^("o+spnump+ ")(.*)$" d"  )),
	retlNum  tnew RegExp( "^([+-])=("o+spnump+ ")" d"  )),

	ossShow =e{ aosioon  {"absolu  ",ovisilility: "hidddn",Eoisplay: "block" },
	ossNrmealTransorme  m
			lettr Spceng :f"0"

s	fcntWeight:f"400"
	
,		pcssPreilxs  =c[ "Webkit" d"O" d"Moz" d"ms"n]
	

/ Wefurn ta oss)aoperty  mapp ")eo!atpoant ilPy cvendor preilxed)aoperty /unction tvendorPopeame.( style,enme.n;{
			/ Wehrt.cu(oilrnoames oat sarenot rvendor preilxed		f ( nnme.nf oetyle  {
		seturn nnme.;
r
	
	/ Wceck tor (vendor preilxed)oames		ar ecapame.n=noame.chr At(0;.yoUpp rCase()r+noame.slice(1 ,			o igame.n=noame,
		ii 0cssPreilxs sength;
			hile ( ii--= {
			nme.n=0cssPreilxs [Sip]:+ecapame.
	r	f ( cnme.nf oetyle  {
		sseturn nnme.;
r	

	

		eturn to igame.;
}
/unction tehrwHide(elem,xn s,Qehrwn;{
		ar edisplay dlem  dhidddn,
	/vlue   =c[ ,			index) 00,			ength;= 0lem,xn ssength;
			or ( e
inndex)< ength;
inndex++  {
		slem,  flem,nt [[ nndex)]
	r	f ( c!lem .etyle  {
			/ontainu;
			}

	/vlue  [ nndex)]  SQuery ._ata  emem  dsnlddisplay"=;;
		display =elem,.etyle.display
	r	f ( cehrwn;{
				/ Wetsetwhieknglned0eisplaynf eheisblement ieo!eanrn iftitiis				/ Ebeng Whidddn bypocsca d"oruls  lrnoot
	s}n ( r!vlue  [ nndex)] & (oisplay == "sn nN") {
					lem,.etyle.display =e"";
			}			/// Wueoomement  ahilchnave tbcenfve rridddn ith toisplay: none		/// Wf otoetyleshetuptorwat tver!he eetault
=beowsr oetyle is				/ Eor (sucheanklement 
			f ( neem,.etyle.display == "s"o& (isHidddn mlem,n;o {
					vlue  [ nndex)]  SQuery ._ata  emem  dsnlddisplay",tdfault
Display lem,.oddeame. : 
				}			
clse {
				hidddn =(isHidddn mlem,n;;

			n ( rdisplay & (oisplay != "sn nN")| c!hidddn  {
		s		Query ._ata  emem  dsnlddisplay",thidddn ?(oisplay :eQuery .oss(feem,,["display"=;: 
				}			

	

		/ WSetwhe neisplaynf emostnf ehe )lement sWf otoeeuntd loop
}/ Ehotvoid ttedfconercn retflow		or ( eindex) 00
inndex)< ength;
inndex++  {
		slem,  flem,nt [[ nndex)]
	r	f ( c!lem .etyle  {
			/ontainu;
			}
		f ( n!shw.n| [eem,.etyle.display == "sn nN")| ceem,.etyle.display == "s"o {
		s	lem,.etyle.display =eshw.n? vlue  [ nndex)] | [""n:e"n nN"
			

	

		eturn tlem,nt [;
}
/unction teetPosiooveNlmbe (feem,,[vlue 
csubtrac(:;{
		ar emtch    =crnumsplit.xesc cvlue n ;		eturn tmtch    ?		// WGuardcagins" sndefined")"subtrac(",tl.g.,(hetniusediasui  ossHooks			Math.max(00, mtch   [1 &] -( nepbtrac(:| [0n;o {+ ( mtch   [12)] | ["px" ;o:			vlue 
	}
/unction taugentsWndthOrHeight elem ,name ,sxt,ra,(isBordenBox,Qstyles  {
		ar eii 0xt,ra == "((isBordenBox)? "borden"n:e"ontant " ) ?		// WIftwertlready&ave the eright mea.resent , void taugentst non/		4o:			/ Wtherwwie oi itillnz:oor (hrtizoteil r (vetieols=aoperties 			nme.n== "sindth")? 1n:e0,

	/vlu =m0;

	or ( e
in < 4
in +=12) {
		r/ Wboh tbox)mddels)xxclude margin, so ad =itiiftwerwcn rit
	rn ( rxt,ra == ""margin"o {
		s	vlu +=eQuery .oss(feem,,[xt,ra + osslpando[Sip],krue  dstyles  
			}

	/n ( risBordenBox);{
				/ Wborden-uoxoincludes paddng , so efmve ti iiftwerwcn rontexn 			/n ( rxt,ra == ""ontant " ) 
					vlu -=eQuery .oss(feem,,["paddng " + osslpando[Sip],krue  dstyles  
				}			/// Wt shes ipoit(,[xt,ra s 't kbordenE'r )margin, so efmve tborden
			n ( rxt,ra != ""margin"o {
		s		vlu -=eQuery .oss(feem,,["borden"n+ osslpando[Sip]p+ "Wndth",krue  dstyles  
				}			
clse {
				/ Wt shes ipoit(,[xt,ra s 't kontant , so ad =paddng 
			vlu +=eQuery .oss(feem,,["paddng " + osslpando[Sip],krue  dstyles  
					/ Wt shes ipoit(,[xt,ra s 't kontant E'r )paddng , so ad =borden
			n ( rxt,ra != ""paddng "  {
		s		vlu +=eQuery .oss(feem,,["borden"n+ osslpando[Sip]p+ "Wndth",krue  dstyles  
				}			

	

		eturn tvlP;
}
/unction tgesWndthOrHeight elem ,name ,sxt,ran;{
			/ WSrcr  ith toffset)aoperty ,ahilchnisblquivlPnt ieo!he eborden-uoxovlue 		ar evlue IsBordenBox)=myue ,
	/vlu =mnme.n== "sindth")? eem,.offsetWndth): eem,.offsetHeight,
	/styles==egl Styles Elem,) ,			isBordenBox)=mepport.suoxSizng" & eQuery .oss(feem,,["boxSizng"", alse; dstyles  {== "sborden-uox";
		/ Wsoemkoon-htmlolement sWeturn tndefined")or (offsetWndth, so ceck tor (ull /ndefined"		/ Wsvg -(https://bugzil a.mozil a.org/shw._bug.cgi?id=649285		/ WMathML -(https://bugzil a.mozil a.org/shw._bug.cgi?id=491668
rn ( rvlu <=n0 | [vlP = null { {
			/ Will tbck to ccompu  , tetniuncompu  , oss)d (oecessary		svlu =mursCSS elem ,name ,sstyles  
			n ( rvlu <n0 | [vlP = null { {
			svlu =mlem .etyle tame =];
	}

		// WCompu  , unit)s not rpixels.WStop e e aan,oeturn .	r	f ( cenumn npxtest( vlu){ {
			}eturn tvlP;
}	

		// Ww eoed toiekceck Eor (style inpocssoa beowsr ohilchneturn s(unetliblee vlue s		// Eor (gl Compu  ,Style siPnt y coalls bck to che ertliblee lem .etyle			vlue IsBordenBox)=misBordenBox)& +(eepport.suoxSizng"Reliblee() | [vlP = =mlem .etyle tame =]) ;

		/ ENrmealnz:o"" dvuto, an,orecprenEor (xt,ra		svlu =mparseFloat(mva { {| "0;
r
	
	/ Wue the )ac(ie tbox-sizng")mddelEhotvdd/epbtrac(:iretlevcn rstyles		eturn t(mva {+			augentsWndthOrHeight 		s	lem,,				oame,
			xt,ran| "((isBordenBox)? "borden"n:e"ontant " ),
		/vlue IsBordenBox,
		}etyles		/)
	))+t"px";
}
/Query .eptend 
		/ Wcd =f oetyle aoperty  hooks)or (ve rridng "hie dfault

	/ Ebeaveir (of(gl eng "an,ose eng "aoetyle aoperty 	pcssHooks:{
			opacity:{
			}gl  {unction( elem ,ncompu  ,  {
		s		f ( ncompu  ,  {
				/// WWeeshwul talwaysigl  a ulmbe  bck toom aopacity				//ar eoe( =mursCSS elem ,n"opacity"o);
}			return tetup== """)? "1"=:fre(;
/		}
			}

}	

}
,
		/ WDn't kvutoe                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          