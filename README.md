# SearchAlgorithmsVisualized
This project was written in september 2016, which was also the second time that I was a teaching assistent for the [Computational Thinking course at the VU](https://www.vu.nl/nl/studiegids/2017-2018/bachelor/c-f/computer-science/index.aspx?view=module&origin=50049123&id=50049587). During this time I noticed that students often stuggle with understanding some sorting algorithms (despite the many good resources there already are available online).

In an attempt to solve this issue, this project was born. The main idea behind this project is to help students understand the various sorting methods better by providing them with more (and better) live-examples. 

(the project was a success and is now being used by the professor on his personal website: [bhulai.nl](http://bhulai.nl))
> Kishan Nirghin
## Impression
![Image of Yaktocat](https://octodex.github.com/images/yaktocat.png)

## How to run
Simply copy the entire folder and host with any apacheserver.
##### Requirements: 
* PHP

## TODO
###### This project could be expanded / improved by adding the following features:
* More control over the now randomly generated graphs (e.g. sliders to adjust the connectivity, or number of nodes)
* Prettier front-end
* Remove PHP dependency

###### My other thoughts for future work
The project now is quite stable; I do feel like it should be re-written at some point (and I will do it once time allows); Some of the things that currently bug me are: 
* the cytoscape library that is being used to render the graphs. Whereas libraries are useful for rapid development, it affects the flexibility of the program. (a good example is that some of the nodes are rendered on top of eachother).
* The Design, which I hate. It should be more attractive to look at and play with; I would love to make the website feel like a playground
* More options, e.g. allow students to draw their own graphs
