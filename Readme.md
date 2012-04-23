jQuery Metricboard
==================

A package for displaying real-time data in a dashboard like interface.

A note
------
This package is released as-is with no warranty.  I haven't tested it anywhere.  Expect it to not work.  Hopefully it is a good starting point for building something truly useful.

Use
===

The vast majority of the work is done from attributes placed on HTML elements.  Each element needs a `refresh-url` and a `refresh-rate`.  Beyond that, specific chart types need specific attributes.

Attribute Descriptions
----------------------

* widget: The type of widget to display.  Expects one of the values below
* refresh-url:  The URL that needs to be polled for new data.  Data is grabbed via AJAX.  Data will need to be returned in JSON format, as specified below.
* refresh-rate:  How often we should check for new data.  This value is in seconds.  Don't go too fast, or else the metricboard will either explode or slow down.
* key:  This is an option attribute.  This key is sent with the AJAX request to verify that the request is coming from the correct source.  This can also be useful if you need to give user-specific information - all you would need is to put the session id in this field
* max:  For list elements, this is the maximum number of elements to display
* useID: This element expects just a blank value (ie: "").  If this element is set on a list element, the list will add the new data to the top of the list, and pop items off the bottom.  This can save some bandwidth because you don't have to grab all the data every time.  Otherwise, you must send the entire data set each time you poll for data.
* title:  Some elements accept a title as an attribute, rather than embeded HTML.

List Element
------------

* widget: mandatory, "textList"
* class: mandatory, "widget textList"
* refresh-url: mandatory
* refresh-rate: mandatory
* max: mandatory,
* key: optional

```
<div class="widget textList" widget="textList" refresh-url="dataGrabbers/listExample.php" refresh-rate="3" max="10" key="123456">
	<span class="header">Recent Uploads</span>
	<ul><!-- This empty UL must be here, or else your list will be nonexistant -->
	</ul>
</div>
```

**Data Format:**
```
{
	"items":
		[
			"<li>My Data</li>",
			"<li>My Other Data</li>"
		],
	"lastID": "100"
}
```

Count Element
-------------
* widget: mandatory, "number"
* class: mandatory, "widget"
* refresh-url: mandatory
* refresh-rate: mandatory
* key: optional

```
<div class="widget"  widget='number' refresh-url="dataGrabbers/countExample.php" refresh-rate="3" key="123456">
	<span class='numberNumber'>0</span><!-- This is the default number -->
	<span class='numberText'>users logged in</span><!-- This is the title -->
</div>
```

**Data Format:**
```
5
```

Pie Chart Element
-----------------
* widget: mandatory, "pieChart"
* class: mandatory, "widget"
* refresh-url: mandatory
* refresh-rate: mandatory,
* title: mandatory
* key: optional

```
<div class="widget" widget="pieChart" refresh-url="dataGrabbers/pieExample.php" refresh-rate="3" title="Daily Activity">
</div>
```

**Data Format:**
```
{
	"Category 1": 3,
	"Category 2": 5,
	"Category 3": 11,
	"Category 4": 4
}
```

Contributors
============
* [Joe Wegner](https://www.twitter.com/Joe_Wegner)

License
=======
[Apache 2.0](http://www.apache.org/licenses/LICENSE-2.0.html)
