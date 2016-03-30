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
    delete elevelist;
}

void AddCarte::onPushActionAddClasse(bool i){
    elevelist = new EleveList(this);
    elevelist->show();
}

void AddCarte::onDoubleClickListEleve(QModelIndex index){
    qDebug() << "AddCarte::onDoubleClickListEleve() > l'ID de l'élève sélectionner est" << index.data(Qt::UserRole + 1).toInt();
}

void AddCarte::closeEvent(QCloseEvent *){
    delete elevelist;
}
