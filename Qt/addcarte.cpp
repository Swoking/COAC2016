#include "addcarte.h"

AddCarte::AddCarte(COAC *fen, QWidget *parent) :
    QDialog(parent),
    fenetre(fen)
{
    setupUi(this);

    elevelist = new EleveList(this);
    connect(pbuChooseEleve, SIGNAL(clicked(bool)), this, SLOT(onPushActionAddClasse(bool)));
}

AddCarte::~AddCarte(){
    elevelist->hide();
}

void AddCarte::onPushActionAddClasse(bool i){
    elevelist = new EleveList(this);
    elevelist->show();
}

void AddCarte::onDoubleClickListEleve(QModelIndex index){
    id = index.data(Qt::UserRole + 1).toInt();
    qDebug() << "AddCarte::onDoubleClickListEleve() > l'ID de l'élève sélectionner est" << id;
    elevelist->hide();

   // QSqlQuery
}

void AddCarte::closeEvent(QCloseEvent *){
    elevelist->hide();
}
