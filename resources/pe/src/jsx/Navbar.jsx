var Navbar = React.createClass({
    render: function () {
        return (
            <nav id="top" className="navbar navbar-default navbar-fixed-top">
                <div className="container-fluid">
                    {/* navbar-header start */}
                    <div className="navbar-header">
                        <button type="button" className="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span className="sr-only">Toggle navigation</span>
                            <span className="icon-bar">&nbsp;</span>
                            <span className="icon-bar">&nbsp;</span>
                            <span className="icon-bar">&nbsp;</span>
                        </button>
                        <a className="navbar-brand" href="<?=$url;?>">Proverbs Everyday</a>
                    </div>
                    {/* navbar-header end */}

                    <div className="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        {/* search-form start */}
                        <form id="search-form" className="navbar-form navbar-left" method="post">
                            <ChapterSelect />
                            &nbsp;
                            <TranslationSelect translations={this.props.translations} />
                            &nbsp;
                            <button className="btn btn-navbar" type="submit" data-toggle="tooltip" title="Search"><i className="fa fa-search fa-fw">&nbsp;</i></button>
                        </form>
                        {/* search-form end */}

                        {/* right links start */}
                        <ul className="nav navbar-nav navbar-right">
                            <li data-toggle="tooltip" title="Paragraph View"><a href="#"><i className="fa fa-align-left fa-fw">&nbsp;</i> <span className="hidden-lg hidden-md hidden-sm">Paragraph</span></a></li>
                            <li data-toggle="tooltip" title="Grid View"><a href="#"><i className="fa fa-th-large fa-fw">&nbsp;</i> <span className="hidden-lg hidden-md hidden-sm">Grid</span></a></li>
                            <li data-toggle="tooltop" title="Back to top"><a href="<?=$url;?>/#top"><i className="fa fa-arrow-up fa-fw">&nbsp;</i> <span className="hidden-lg hidden-md hidden-sm">Back to Top</span></a></li>
                        </ul>
                        {/* right links end */}
                    </div>
                </div>
            </nav>
        );
    }
});